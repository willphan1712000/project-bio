<?php

namespace api\users\validation;

use api\ApiProcessing\ApiPublic;
use api\Request;
use api\Response;
use business\user\signup\CheckUsername;
use business\user\signup\Input;
use config\SystemConfig;

class Username extends ApiPublic
{
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'];

        if($username === null) {
            $response->setStatusCode(400)->json(SystemConfig::apiJSONformat(error: 'username is missing'));
            return false;
        }

        $response->json(SystemConfig::apiJSONformat(status: (new CheckUsername(null))->doHandle(new Input($username, null, null))));
    }
}
