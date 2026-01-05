<?php

namespace api\users\validation;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\user\signup\CheckEmail;
use business\user\signup\Input;
use config\SystemConfig;

class Email extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $email = $body['email'];

        if($email === null) {
            $response->setStatusCode(400)->json(SystemConfig::apiJSONformat(error: 'email is missing'));
            return false;
        }

        $response->json(SystemConfig::apiJSONformat(status: (new CheckEmail(null))->doHandle(new Input(null, $email, null))));
    }
}
