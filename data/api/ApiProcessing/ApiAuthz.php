<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;
use business\auth\Authz;

class ApiAuthz extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        $isAuthorized = Authz::checkPermision($request->getUsername(), $request->getPermission());
        if (!$isAuthorized) {
            $response->setStatusCode(403)->json([
                'success' => false,
                'error' => 'User is not authorized to access resources'
            ]);
            return false;
        }

        return true;
    }
}
