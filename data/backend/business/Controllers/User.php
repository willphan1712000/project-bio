<?php

namespace business\Controllers;

use business\auth\Auth;
use business\Controllers\UserLogics\UserManagement;
use business\info\userGET;
use business\style\GET;
use business\template\TemplateManagement;
use business\user\activation\GET as ActivationGET;
use config\SystemConfig;

interface UserInterface
{
    /**
     * initialize some necessary user information
     */
    public function iniUser(): void;

    /**
     * This checks if a user is signed in. If so, set status to true, username, and template_id. Otherwise, set status to false
     */
    public function checkSignedIn(): void;

    /**
     * This checks provided user credentials and grant access to the cookies
     */
    public function generateAuth(): bool;

    /**
     * This checks of the user is deactivated.
     * @return bool true if there is not a delete token for this user, and false otherwise
     */
    public function isActiveAccount();

    /**
     * This returns all necessary data for this user
     */
    public function fetchData();
}

class User extends UserManagement implements UserInterface
{
    protected bool $isSignedIn;
    protected ?string $username;
    protected ?string $password;
    protected int $template_id;
    protected array $socialIconArr;
    protected string $url;
    protected array $info;
    protected array $css;
    protected $g;

    public function __construct(?string $username = null, ?string $password = null)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function iniUser(): void
    {
        $this->username = SystemConfig::URLExtraction();
        $this->setTemplateId($this->username);
    }

    private function setTemplateId($username): void
    {
        $this->template_id = TemplateManagement::shareTemplate($username, (int) SystemConfig::URLExtraction(queryStr: "tem"));
    }

    public function checkSignedIn(): void
    {
        $auth = new Auth();

        $res = $auth->auth();

        $this->isSignedIn = $res['success'];
        if ($this->isSignedIn) {
            $this->username = $res['username'];
            $this->setTemplateId($this->username);
        }
    }

    public function generateAuth(): bool
    {
        return $this::auth(
            username: $this->username,
            password: $this->password
        );
    }

    public function isActiveAccount()
    {
        try {
            $deleteToken = (new ActivationGET($this->username))->execute();
            return $deleteToken === NULL;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function fetchData()
    {
        $this->socialIconArr = SystemConfig::socialIconArr(); // get icon array
        $this->url = $this::URLGenerator($this->username, "share"); // get url based on username
        $this->g = SystemConfig::globalVariables();

        $infoProcess = (new userGET($this->username, true))->execute();
        $this->info = $infoProcess['success'] ? $infoProcess['data'] : null; // get info map

        $cssBackend = (new GET($this->username, $this->template_id))->execute();
        $this->css = $cssBackend['success'] ? $cssBackend['data'] : null; // get template style array
    }

    public function get($getWhat)
    {
        return $this->$getWhat;
    }

    public function set($setWhat, $value)
    {
        $this->$setWhat = $value;
    }
}
