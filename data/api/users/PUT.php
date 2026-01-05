<?php

namespace api\users;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\user\GET as UserGET;
use business\user\PUT as UserPUT;

/**
 * This handles getting a specific user with username or id
 */
class PUT extends ApiPrivate {
    /**
     * @param Request $request The request object.
     * @param Response $response The response object.
     */
    public function doHandle(Request $request, Response $response)
    {
        $username = $request->getId()[0];

        $body = $request->getBody();

        if(!isset($body['password'])) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'Password is required'
            ]);
        }

        $password = $body['password'];

        $users = (new UserPUT(
            username: $username,
            password: $password
        ))->execute();

        $response->setStatusCode(200)->json($users);
    }
}