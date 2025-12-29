<?php

namespace api\purchase;

use api\Request;
use api\Response;

use api\ApiProcessing\ApiPrivate;
use business\purchase\POST as TemplatePOST;

require_once __DIR__ . "/../../../vendor/autoload.php";

class POST extends ApiPrivate
{   
    public function doHandle(Request $request, Response $response)
    {
        $body = $request->getBody();
        $username = $body['username'] ?? NULL;
        $templates = $body['templates'] ?? NULL;
        
        $response->setStatusCode(200)->json([
            'success' => (new TemplatePOST($username, $templates))->execute()
        ]);
    }
}
