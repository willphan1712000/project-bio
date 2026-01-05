<?php

namespace api\pricing;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use config\ExternalServices\TemplateServer\pricing\Pricing;
use config\SystemConfig;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $pricing = new Pricing();
        $response->setStatusCode(200)->json(
            SystemConfig::apiJSONformat(
                data: $pricing->get()
            )
        );
    }
}
