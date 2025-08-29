<?php

namespace api\analytics;

use api\Request;
use api\Response;
use business\analytics\Analytics;

class AnalyticsController
{
    protected Request $request;
    protected Response $response;
    protected Analytics $analytics;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->analytics = new Analytics();
    }

    /**
     * This function will get every needed analytics information
     */
    public function get()
    {
        $number_of_templates = $this->analytics->getTotalTemplate();
        $nubmer_of_subscription = 0;
        $number_of_users = $this->analytics->getTotalUsers();

        $this->response->setStatusCode(200)->json([
            "success" => true,
            "data" => [
                "numberOfTemplates" => $number_of_templates,
                "numberOfSubscriptions" => $nubmer_of_subscription,
                "numberOfUsers" => $number_of_users
            ]
        ]);
    }

    public function getUserSocial()
    {
        $this->response->setStatusCode(200)->json([
            "success" => true,
            "data" => $this->analytics->getSocial()
        ]);
    }
}
