<?php

namespace api\ApiProcessing;

use api\Request;
use api\Response;

class ApiTest extends ApiProcess
{
    public function doHandle(Request $request, Response $response)
    {
        $data = $request->getMethod();
        $response->setStatusCode(200)->json([
            'data' => $data
        ]);
    }
}
