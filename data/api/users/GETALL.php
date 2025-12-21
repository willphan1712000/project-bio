<?php

namespace api\users;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\user\GET as UserGET;

class GETALL extends ApiPrivate {
    public function doHandle(Request $request, Response $response)
    {
        $users = (new UserGET(
            limit: 100,
            offset: 0
        ))->execute();

        $response->setStatusCode(200)->json($users);
    }
}