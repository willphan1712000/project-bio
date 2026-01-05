<?php

namespace api\info;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPublic;
use business\info\userGET as InfoUserGET;

class userGET extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => (new InfoUserGET($username))->execute()
        ]);
    }
}