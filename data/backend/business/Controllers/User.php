<?php

namespace business\Controllers;

use business\auth\Auth;
use business\info\userGET;
use business\style\GET;
use business\template\TemplateManagement;
use business\user\UserManagement;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User as EntityUser;

interface UserInterface
{
    /**
     * This checks if a user is signed or not
     */
    public function checkSignedIn(): void;

    /**
     * This checks if the user is deactivated. If so, redirect them to restore page. Otherwise, allow access to admin
     */
    public function checkRestoreAccount();

    /**
     * This checks of the user is deactivated.
     * @return bool true if there is not a delete token for this user, and false otherwise
     */
    public function checkDeactivation();

    /**
     * This returns all necessary data for this user
     */
    public function fetchData();
}

class User implements UserInterface
{
    protected bool $isSignedIn;
    protected string $username;
    protected int $template_id;
    protected array $socialIconArr;
    protected string $url;
    protected array $info;
    protected array $css;
    protected $g;

    public function __construct()
    {
        $this->username = SystemConfig::URLExtraction();
        $this->template_id = TemplateManagement::shareTemplate($this->username, (int) SystemConfig::URLExtraction(queryStr: "tem"));
    }

    public function checkSignedIn(): void
    {
        // Get token from cookies sent along with each request (controller or api call)
        $token = $_COOKIE[SystemConfig::globalVariables()['auth']['auth_property']] ?? NULL;

        $auth = new Auth(
            token: $token
        );

        $res = $auth->auth();

        $this->username = $res['username'];
        $this->isSignedIn = $res['success'];
    }

    public function checkRestoreAccount() {}

    public function checkDeactivation()
    {
        $deleteToken = Database::GET(EntityUser::class, 'deleteToken', ['username' => $this->username]) ?? NULL;

        return $deleteToken === NULL;
    }

    public function fetchData()
    {
        $this->socialIconArr = SystemConfig::socialIconArr(); // get icon array
        $this->url = UserManagement::URLGenerator($this->username, "share"); // get url based on username
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
