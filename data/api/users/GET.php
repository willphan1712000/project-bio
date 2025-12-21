<?php

namespace api\users;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\user\GET as UserGET;

/**
 * This handles getting a specific user with username or id
 */
class GET extends ApiPrivate {
    /**
     * @param Request $request The request object.
     * @param Response $response The response object.
     */
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];

        $users = (new UserGET(
            username: $username,
            limit: 1,
            offset: 0,
        ))->execute();

        $response->setStatusCode(200)->json($users);
    }
}