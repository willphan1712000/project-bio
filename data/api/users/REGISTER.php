<?php

namespace api\users;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\user\POST;

/**
 * This handles register a new user to the system
 */
class REGISTER extends ApiPublic {
    /**
     * @param Request $request The request object.
     * @param Response $response The response object.
     * @throws \Exception If required fields (username, password, email) are missing.
     * @return void
     */
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();

        if (!isset($body['username']) || !isset($body['password']) || !isset($body['email'])) {
            throw new \Exception('Username, password, and email are required.');
        }

        $username = $body['username'];
        $password = $body['password'];
        $email = $body['email'];

        $result = (new POST(username: $username, password: $password, email: $email))->execute();

        $response->setStatusCode(200)->json([
            'success' => $result
        ]);
    }
}