<?php

namespace api\pricing;

use api\APIAuth;
use business\auth\Authz;
use business\pricing\Pricing;

class GET extends APIAuth
{
    public function handleRequest(...$arg)
    {
        $pricing = new Pricing();
        return $pricing->get();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "get:pricing");
    }
}
