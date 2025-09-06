<?php

namespace api\analytics;

use api\APIAuth;
use business\analytics\Analytics;
use business\auth\Authz;

class GET extends APIAuth
{
    public function handleRequest(...$args)
    {
        $analytics = new Analytics();

        $number_of_templates = $analytics->getTotalTemplate();
        $nubmer_of_subscription = 0;
        $number_of_users = $analytics->getTotalUsers();

        return [
            "numberOfTemplates" => $number_of_templates,
            "numberOfSubscriptions" => $nubmer_of_subscription,
            "numberOfUsers" => $number_of_users
        ];
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "get:analytics");
    }
}
