<?php

namespace api\analytics;

use api\ApiProcessing\ApiPrivate;
use config\ExternalServices\TemplateServer\analytics\Analytics;
use api\Request;
use api\Response;

class GET extends ApiPrivate
{
    public function doHandle(Request $request, Response $response)
    {
        $analytics = new Analytics();
    
        $number_of_templates = $analytics->getTotalTemplate();
        $nubmer_of_subscription = 0;
        $number_of_users = $analytics->getTotalUsers();
    
        $data = [
            "numberOfTemplates" => $number_of_templates,
            "numberOfSubscriptions" => $nubmer_of_subscription,
            "numberOfUsers" => $number_of_users
        ];

        $response->setStatusCode(200)->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
