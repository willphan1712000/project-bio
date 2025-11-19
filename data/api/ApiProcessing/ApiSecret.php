<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

class ApiSecret extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        $secret = $request->getSecretKey();
        if ($secret !== $_ENV["SYSTEM_SECRET_KEY"]) {
            $response->setStatusCode(403)->json([
                'success' => false,
                'error' => 'Missing secret key'
            ]);
            return false;
        }

        return true;
    }
}
