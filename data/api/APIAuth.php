<?php

namespace api;

use business\auth\Auth;
use config\SystemConfig;

abstract class APIAuth implements API
{
    protected Request $request;
    protected Response $response;
    protected string $username;
    protected bool $status;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

        $headers = $this->request->getHeaders();

        $token = $headers[SystemConfig::globalVariables()['auth']['token_property']] ?? NULL;

        $auth = (new Auth(null, null, $token))->auth();
        $this->status = $auth['success'];
        $this->username = $auth['username'] ?? NULL;
    }

    protected function getUsername()
    {
        return $this->username;
    }

    abstract public function handleRequest(...$arg);

    abstract protected function checkPermission(?string $username = null);

    public function execute(...$args)
    {

        if (!$this->status || !$this->checkPermission($this->username)) {
            return $this->response->setStatusCode(401)->json([
                "success" => false,
                "error" => "User not signed in or does not have right permission, deny access to resources"
            ]);
        }

        try {
            $this->response->setStatusCode(200)->json([
                'success' => true,
                'data' => $this->handleRequest(...$args)
            ]);
        } catch (\Exception $e) {
            $this->response->setStatusCode(400)->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
