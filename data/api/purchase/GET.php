<?php

namespace api\purchase;

use api\Request;
use api\Response;

use api\ApiProcessing\ApiPrivate;
use business\purchase\GET as TemplateGET;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => (new TemplateGET($username))->execute()
        ]);
    }
}