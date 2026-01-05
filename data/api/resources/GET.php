<?php

namespace api\resources;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\resources\Info;

class GET extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $resources = new Info();
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $resources->get()
        ]);
    }
}
