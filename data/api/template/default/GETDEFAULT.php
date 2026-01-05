<?php

namespace api\template\default;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use business\template\DefaultTemplate;

class GETDEFAULT extends ApiPrivate {
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];
        $obj = new DefaultTemplate();

        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $obj->get($username)
        ]);
    }
}