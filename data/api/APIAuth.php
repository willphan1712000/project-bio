<?php

namespace api;

use business\auth\Auth;
use config\SystemConfig;

abstract class APIAuth implements API
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    abstract public function handleRequest(...$arg);

    abstract protected function checkPermission(?string $username = null);

    public function execute(...$args)
    {
        $headers = $this->request->getHeaders();
        $token = $headers[SystemConfig::globalVariables()['auth']['token_property']] ?? NULL;

        $auth = (new Auth(null, null, $token))->auth();
        $status = $auth['success'];
        $username = $auth['username'] ?? NULL;
        // if (!$status || !$this->checkPermission($username)) {
        //     return $this->response->setStatusCode(401)->json([
        //         "success" => false,
        //         "error" => "User not signed in or does not have right permission, deny access to resources"
        //     ]);
        // }

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
