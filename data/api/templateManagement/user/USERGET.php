<?php

namespace api\templateManagement\user;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\Controllers\User;
use business\templateManagement\TemplateUser;

class USERGET extends ApiPublic
{
    protected Request $request;
    protected Response $response;

    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'] ?? NULL;
        $template_id = $body['template_id'] ?? NULL;

        if($username === NULL) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'username is missing'
            ]);
            
            return false;
        }

        if($template_id === NULL) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'template id is missing'
            ]);
            
            return false;
        }

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
            $response->setStatusCode(200)->json([
                'success' => true,
                'data' => array_merge(
                    $userTemplate->getTemplate($username, $template_id),
                    $userTemplate->getUser($username)
                )
            ]);
        } catch (\Exception $e) {
            $response->setStatusCode(400)->json([
                'success' => true,
                'error' => $e->getMessage()
            ]);
        }
    }
}
