<?php

namespace api\user;

use api\ApiProcessing\ApiProcess;
use api\Request;
use api\Response;
use business\user\DELETEHOLD;

/**
 * This class handles deleting a user temporarily
 */
class DELETETEMP extends ApiProcess
{
    public function doHandle(Request $request, Response $response)
    {
        $result = (new DELETEHOLD($request->getUsername() ?? NULL))->execute();

        $response->setStatusCode(200)->json($result);
    }

    public function execute()
    {
        $this->request->setPermission("deletehold:user"); // set permission to the request before starting the api process

        $this->startProcessing();
    }
}
