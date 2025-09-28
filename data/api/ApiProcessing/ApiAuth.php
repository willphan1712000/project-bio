<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

class ApiAuth extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        // $response->setStatusCode(401)->json([
        //     'error' => 'You are not anthenticated, please log in'
        // ]);
        return true;
    }
}
