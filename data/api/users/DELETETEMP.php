<?php

namespace api\users;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\user\DELETEHOLD;

/**
 * This class handles deleting a user temporarily
 */
class DELETETEMP extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $id = $request->getId();

        if ($id === null) throw new \Exception("id is not provided");

        $result = (new DELETEHOLD($id[0] ?? NULL))->execute();

        $response->setStatusCode(200)->json($result);
    }
}