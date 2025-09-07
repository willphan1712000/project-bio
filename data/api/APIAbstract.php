<?php

namespace api;

use business\user\UserManagement;
use config\SystemConfig;

header('Content-Type: application/json');
SESSION_START();

abstract class APIAbstract implements API
{
    protected $headers;
    protected $body;

    function __construct()
    {
        $this->body = json_decode(file_get_contents("php://input"));
        $this->headers = getallheaders();
    }

    abstract public function handleRequest($body);

    public function execute()
    {
        $token = $this->headers[SystemConfig::globalVariables()['auth']['token_property']] ?? NULL;
        // Verify user has already signed in before giving access to resources
        if (UserManagement::isSignedIn($_SESSION, $this->body->username, $token)) {
            $username = UserManagement::getUsername($token);
            $this->body->username = $username;
            return $this->handleRequest($this->body); // Return authorized resource
        } else {
            return [
                "success" => false,
                "error" => "User not signed in, deny access to resources"
            ];
        }
    }
}
