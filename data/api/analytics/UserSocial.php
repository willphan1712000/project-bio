<?php

namespace api\analytics;

use api\APIAuth;
use api\Request;
use api\Response;
use business\auth\Authz;

class UserSocial extends APIAuth
{
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function handleRequest(...$args)
    {
        return $this->response->setStatusCode(200)->json([
            'success' => true,
            'data' => $this->analytics->getSocial()
        ]);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, 'get:usersocial');
    }
}
