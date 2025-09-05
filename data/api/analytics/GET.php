<?php

namespace api\analytics;

use api\APIAuth;
use api\Request;
use api\Response;
use business\auth\Authz;

class GET extends APIAuth
{
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function handleRequest(...$args)
    {
        $number_of_templates = $this->analytics->getTotalTemplate();
        $nubmer_of_subscription = 0;
        $number_of_users = $this->analytics->getTotalUsers();

        return "Hello";

        return $this->response->setStatusCode(200)->json([
            'success' => true,
            'data' => [
                "numberOfTemplates" => $number_of_templates,
                "numberOfSubscriptions" => $nubmer_of_subscription,
                "numberOfUsers" => $number_of_users
            ]
        ]);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "get:analytics");
    }
}
