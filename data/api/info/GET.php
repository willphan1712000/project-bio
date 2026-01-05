<?php

namespace api\info;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use business\info\GET as infoGET;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];

        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => (new infoGET($username))->execute()
        ]);
    }
}
