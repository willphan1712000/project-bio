<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;
use business\auth\Auth;

class ApiAuth extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        $auth = new Auth($request);
        $auth_checked = $auth->auth();

        if ($auth_checked['success']) {
            $request->setUsername($auth_checked['username']);
            return true;
        }

        $response->setStatusCode(401)->json([
            'success' => false,
            'error' => 'Failed to authenticate user, denied access to resources'
        ]);
        return false;
    }
}
