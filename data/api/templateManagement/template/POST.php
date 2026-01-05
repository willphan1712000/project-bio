<?php

namespace api\templateManagement\template;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\Template;

class POST extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $template = new Template();
        return $template->post();
    }
}
