<?php

namespace api\pricing;

use api\APIAuth;
use business\auth\Authz;
use business\pricing\Pricing;

class PUT extends APIAuth
{
    public function handleRequest(...$args)
    {
        $pricing = new Pricing();
        return $pricing->put(...$args);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "put:pricing");
    }
}
