<?php

namespace business\auth;

use api\Request;
use business\auth\JWTAuth;
use business\auth\Session;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User;

interface AuthInterface
{
    /**
     * This function return array [ success, username ] where success is a bool that checks whether user is signed in or not
     */
    public function auth(): array;

    /**
     * This function handles verifying credentials and generating auth information
     */
    public function generateAuth(): bool | string;
}


enum STRATEGY
{
    case SESSION;
    case JWT;
}

/**
 * Dealing with chosen auth strategy
 */
class Auth implements AuthInterface
{
    protected AuthInterface $auth;
    protected ?Request $request;

    public function __construct(?Request $request = NULL)
    {
        $this->request = $request;
        $strategy = SystemConfig::globalVariables()["auth"]["auth_strategy"];

        switch ($strategy) {
            case STRATEGY::SESSION:
                $this->auth = new Session(request: $request);
                break;
            case STRATEGY::JWT:
                $this->auth = new JWTAuth(request: $request);
                break;
            default:
                break;
        }
    }

    public function auth(): array
    {
        return $this->auth->auth();
    }

    public function generateAuth(): bool|string
    {
        if ($this->request === NULL) {
            $username = $_POST['username'] ?? NULL;
            $password = $_POST['password'] ?? NULL;
        } else {
            $body = $this->request->getBody();
            $username = $body['username'] ?? NULL;
            $password = $body['password'] ?? NULL;
        }

        if (!$this->verify(username: $username, password: $password)) return false;
        return $this->auth->generateAuth();
    }

    /**
     * This method handles verifying user credentials, taking username and password and verify for these information
     */
    protected function verify(?string $username = NULL, ?string $password = NULL): bool
    {
        if ($username === NULL || $password === NULL) return false;

        if ($username === SystemConfig::globalVariables()['aicAccount']['username']) {
            return $password === SystemConfig::globalVariables()['aicAccount']['password'];
        }

        $hashedPassword = Database::GET(User::class, "password", ["username" => $username]);

        return password_verify($password, $hashedPassword);
    }
}
