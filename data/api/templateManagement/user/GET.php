<?php

namespace api\templateManagement\user;

use api\Request;
use api\Response;
use business\templateManagement\TemplateUser;

class GET
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function execute(...$arg)
    {
        $body = $this->request->getBody();
        $username = $body['username'];
        $template_id = $body['template_id'] ?? NULL;

        $userTemplate = new TemplateUser();
        $this->response->setStatusCode(200)->json([
            'success' => true,
            'data' => $userTemplate->get($username, $template_id)
        ]);
    }
}
