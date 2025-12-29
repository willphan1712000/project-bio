<?php

namespace api\pricing;

use api\Request;
use api\Response;
use api\ApiProcessing\ApiPrivate;
use config\ExternalServices\TemplateServer\pricing\Pricing;
use config\SystemConfig;

class POST extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $pricing = new Pricing();
        $data = $this->request->getBody();
        $response->setStatusCode(200)->json(
            SystemConfig::apiJSONformat(data: $pricing->post($data))
        );
    }
}
