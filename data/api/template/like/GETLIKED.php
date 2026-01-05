<?php

namespace api\template\like;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use business\template\LikedTemplate;

class GETLIKED extends ApiPrivate {
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];
        $obj = new LikedTemplate();

        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $obj->get($username)
        ]);
    }
}