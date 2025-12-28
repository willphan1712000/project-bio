<?php

namespace api\templateManagement\template;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\Template;

class GETURL extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $template = new Template();
        $url = $template->getTemplateServerURL();
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $url
        ]);
    }
}
