<?php

namespace api\analytics;

use api\APIAuth;
use business\analytics\Analytics;
use business\auth\Authz;

class UserSocial extends APIAuth
{
    public function handleRequest(...$args)
    {
        $analytics = new Analytics();

        return  $analytics->getSocial();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, 'get:usersocial');
    }
}
