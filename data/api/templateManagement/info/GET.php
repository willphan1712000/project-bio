<?php

namespace api\templateManagement\info;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use business\templateManagement\TemplateInfo;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $id = $request->getId()[0];

        $template = new TemplateInfo();
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $template->get($id)
        ]);
    }
}
