<?php

namespace api\pricing;

use api\ApiProcessing\ApiPrivate;
use api\Request;
use api\Response;
use config\ExternalServices\TemplateServer\pricing\Pricing;

class POST extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $pricing = new Pricing();
        $data = $this->request->getBody();
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $pricing->post($data)
        ]);
    }
}
