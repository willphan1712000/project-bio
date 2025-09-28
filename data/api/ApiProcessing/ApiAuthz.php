<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

class ApiAuthz extends ApiHandler
{
    public function doHandle(Request $request, Response $response)
    {
        // $response->setStatusCode(403)->json([
        //     'error' => 'you are not authorized to access'
        // ]);
        return true;
    }
}
