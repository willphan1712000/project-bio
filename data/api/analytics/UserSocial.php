<?php

namespace api\analytics;

use api\Request;
use api\Response;
use config\ExternalServices\TemplateServer\analytics\Analytics;
use api\ApiProcessing\ApiPrivate;

class UserSocial extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $analytics = new Analytics();
        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $analytics->getSocial()
        ]);
    }
}
