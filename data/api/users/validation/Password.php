<?php

namespace api\users\validation;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\user\signup\Input;
use business\user\signup\Password as IsValidPassword;
use config\SystemConfig;

class Password extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $password = $body['password'];

        if($password === null) {
            $response->setStatusCode(400)->json(SystemConfig::apiJSONformat(error: 'password is missing'));
            return false;
        }

        $response->json(SystemConfig::apiJSONformat(status: (new IsValidPassword(null))->doHandle(new Input(null, null, $password))));
    }
}