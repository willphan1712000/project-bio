<?php

namespace api;

use business\Controllers\User;

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
        $user = new User();
        $user->checkSignedIn();

        // Verify user has already signed in before giving access to resources
        if ($user->get("isSignedIn")) {
            $username = $user->get("username");
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
