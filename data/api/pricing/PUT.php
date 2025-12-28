<?php

namespace api\pricing;

use api\Request;
use api\Response;
use config\ExternalServices\TemplateServer\pricing\Pricing;
use api\ApiProcessing\ApiPrivate;

class PUT extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $id = $request->getId()[0];

        $pricing = new Pricing();
        return $pricing->put($id);
    }
}
