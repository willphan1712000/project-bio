<?php

namespace api\templateManagement\user;

use api\Request;
use api\Response;
use business\Controllers\User;
use business\templateManagement\TemplateUser;

class USERGET
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
        $username = $body['username'] ?? NULL;
        $template_id = $body['template_id'] ?? NULL;

        if ($username === '@admin') {
            $user = new User();
            $user->checkSignedIn();
            if ($user->get("isSignedIn")) {
                $username = $user->get("username");
                $template_id = $user->get("template_id");
            }
        }

        $userTemplate = new TemplateUser();
        try {
            $this->response->setStatusCode(200)->json([
                'success' => true,
                'data' => array_merge(
                    $userTemplate->getTemplate($username, $template_id),
                    $userTemplate->getUser($username)
                )
            ]);
        } catch (\Exception $e) {
            $this->response->setStatusCode(400)->json([
                'success' => true,
                'error' => $e->getMessage()
            ]);
        }
    }
}
