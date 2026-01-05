<?php

namespace api\template\like;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use business\template\LikedTemplate;

class DELETELIKED extends ApiPrivate {
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'] ?? NULL;
        $template_id = $body['template_id'] ?? NULL;

        $obj = new LikedTemplate();

        $response->setStatusCode(200)->json([
            'success' => $obj->delete($username, $template_id)
        ]);
    }
}