<?php

namespace business\auth;

use business\auth\JWTAuth;
use business\auth\Session;
use config\SystemConfig;
use persistence\Database;
use persistence\Entity\User;

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
    protected $username;
    protected $password;

    public function __construct($username, $password, ...$arg)
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

    public function auth(): bool
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
