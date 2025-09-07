<?php

namespace api\resources;

use api\APIAuth;
use business\auth\Authz;
use business\resources\Info;

class GET extends APIAuth
{
    public function handleRequest(...$arg)
    {
        $resources = new Info();
        return $resources->get();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "get:resources");
    }
}
