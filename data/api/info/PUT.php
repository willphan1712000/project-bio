<?php

namespace api\info;

use api\Request;
use api\Response;
use business\info\Info;
use business\info\PUT as InfoPUT;
use api\ApiProcessing\ApiPrivate;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $infoArr = $request->getBody();

        $response->setStatusCode(200)->json([
            'success' => (new InfoPUT(new Info($infoArr)))->execute()
        ]);
    }
}
