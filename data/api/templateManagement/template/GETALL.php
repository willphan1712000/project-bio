<?php

namespace api\templateManagement\template;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\Template;

class GETALL extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $templates = (new Template())->get();
        $response->setStatusCode(200)->json($templates);
    }
}
