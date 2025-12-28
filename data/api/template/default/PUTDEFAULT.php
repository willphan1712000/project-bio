<?php

namespace api\template\default;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use business\template\DefaultTemplate;

class PUTDEFAULT extends ApiPrivate {
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'] ?? NULL;
        $template_id = $body['template_id'] ?? NULL;

        $obj = new DefaultTemplate();

        $response->setStatusCode(200)->json([
            'success' => $obj->put($username, $template_id)
        ]);
    }
}