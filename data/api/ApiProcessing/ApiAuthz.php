<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;
use business\auth\Authz;

class ApiAuthz extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        return $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $request->getEndpoint()
        ]);

        $isAuthorized = Authz::checkPermision($request);
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
