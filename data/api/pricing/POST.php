<?php

namespace api\pricing;

use api\APIAuth;
use business\auth\Authz;
use business\pricing\Pricing;

class POST extends APIAuth
{
    public function handleRequest(...$arg)
    {
        $pricing = new Pricing();
        $data = $this->request->getBody();
        return $pricing->post($data);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "post:pricing");
    }
}
