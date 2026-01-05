<?php

namespace business\auth;

use api\Request;
use config\SystemConfig;
use Exception;

/**
 * Session-based Authorization
 */
class Session implements AuthInterface
{
    protected ?string $username;

    public function __construct(?Request $request = NULL)
    {
        if ($request === NULL) {
            $this->username = $_POST['username'] ?? NULL;
        } else {
            $body = $request->getBody();
            $this->username = $body['username'] ?? NULL;
        }
    }

    public function auth(): array
    {
        if (isset($_SESSION['username'])) {
            if (time() - $_SESSION['last_time'] > SystemConfig::globalVariables()['timeSession']) {
                unset($_SESSION['username']);
                return [
                    'success' => false
                ];
            } else {
                $_SESSION['last_time'] = time();
                return [
                    'success' => true,
                    'username' => $_SESSION['username']
                ];
            }
        } else {
            return [
                'success' => false
            ];
        }
    }

    /**
     * This function helps creating a session stored on cookies including signin information
     */
    public function generateAuth(): bool
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['last_time'] = time();

        return true;
    }
}
