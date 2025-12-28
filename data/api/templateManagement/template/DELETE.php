<?php

namespace api\templateManagement\template;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\Template;

class DELETE extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $id = $request->getId()[0];
        
        $template = new Template();
        return $template->delete($id);
    }
}
