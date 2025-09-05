<?php

namespace api\templateManagement\template;

use business\auth\Authz;

class GETALL extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->get();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username);
    }
}
