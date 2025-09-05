<?php

namespace api\templateManagement\template;

use business\auth\Authz;

class GET extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->getId(...$args);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username);
    }
}
