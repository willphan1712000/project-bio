<?php

namespace business\auth;

use business\auth\JWTAuth;
use business\auth\Session;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User;

interface AuthInterface
{
    /**
     * This function handles checking if the user is signed in or not
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
    protected ?string $username;
    protected ?string $password;

    public function __construct(?string $username, ?string $password, ...$arg)
    {
        $strategy = SystemConfig::globalVariables()["auth"]["auth_strategy"];
        $this->username = $username;
        $this->password = $password;

        switch ($strategy) {
            case STRATEGY::SESSION:
                $this->auth = new Session($username);
                break;
            case STRATEGY::JWT:
                $this->auth = new JWTAuth($username, ...$arg);
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
        if (!$this->verify()) return false;
        return $this->auth->generateAuth();
    }

    /**
     * This method handles verifying user credentials, taking username and password and verify for these information
     */
    protected function verify(): bool
    {
        if ($this->username === SystemConfig::globalVariables()['aicAccount']['username']) {
            return $this->password === SystemConfig::globalVariables()['aicAccount']['password'];
        }

        $hashedPassword = Database::GET(User::class, "password", ["username" => $this->username]);

        return password_verify($this->password, $hashedPassword);
    }
}
