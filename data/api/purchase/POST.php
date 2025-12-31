<?php

namespace api\purchase;

use api\Request;
use api\Response;

use api\ApiProcessing\ApiPrivate;
use business\purchase\POST as TemplatePOST;
use config\SystemConfig;

require_once __DIR__ . "/../../../vendor/autoload.php";

class POST extends ApiPrivate
{   
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'] ?? NULL;
        $template = $body['template'] ?? NULL;
        $period = $body['period'] ?? NULL;

        if($username === null || $template === null || $period === null) {
            $response->setStatusCode(400)->json(
                SystemConfig::apiJSONformat(
                    error: "either username or template or period is missing"
                )
            );
            return false;
        }
        
        $response->setStatusCode(200)->json([
            'success' => (new TemplatePOST($username, $template, $period))->execute()
        ]);
    }
}
