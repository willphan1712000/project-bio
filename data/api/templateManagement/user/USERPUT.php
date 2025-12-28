<?php

namespace api\templateManagement\user;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\TemplateUser;

class USERPUT extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        /**
         * @var string | null
         */
        $username = $body['username'] ?? NULL;
        if($username === NULL) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'username is missing'
            ]);

            return false;
        }

        /**
         * @var array | null
         */
        $infoArray = $body['infoArray'] ?? NULL;
        if($infoArray === NULL) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'info array is missing'
            ]);
            
            return false;
        }

        /**
         * @var array | null
         */
        $styleArray = $body['styleArray'] ?? NULL;
        if($styleArray === NULL) {
            $response->setStatusCode(400)->json([
                'success' => false,
                'error' => 'style array is missing'
            ]);
            
            return false;
        }

        $templateUser = new TemplateUser();
        $result = $templateUser->updateUser(
            username: $username,
            infoArray: $infoArray,
            styleArray: $styleArray
        );

        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $result
        ]);
    }
}
