<?php

namespace controllers\signin;

use config\SystemConfig;
use persistence\Database;
use controllers\Controller;
use persistence\Entity\User;
use business\user\UserManagement;

class SigninController extends Controller
{
    protected string $username;
    protected string $password;
    protected $g;
    protected $title;
    protected string $error;
    protected $template;

    function __construct()
    {
        $this->g = SystemConfig::globalVariables();
        $this->title = "Sign In";
        $this->error = "";
        $this->username = "";
        $this->password = "";

        if (SystemConfig::URLExtraction(queryStr: "restore") === 'true') {
            $this->title = "Restore Account";
        }

        $this->template = SystemConfig::URLExtraction(queryStr: "template");
    }

    public function execute()
    {
        // check if user exists
        if (UserManagement::isUserExist($this->username)) {
            // check if password is correct
            if (UserManagement::auth($_SESSION, $this->username, $this->password)) {
                if ($this->template === 'true') {
                    header("Location: /@template?username=" . $this->username);
                } else {
                    header("Location: /" . $this->username . "/admin");
                }
            } else {
                $this->error = "The password is not correct";
            }
        } else if ($this->username === $this->g['aicAccount']['username']) {
            if (UserManagement::auth($_SESSION, $this->username, $this->password)) {
                header("Location: /@aic");
            } else {
                $this->error = "The password is not correct";
            }
        } else {
            $this->error = "The username does not exist";
        }
    }

    public function signin(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;

        $this->execute();
    }
}
