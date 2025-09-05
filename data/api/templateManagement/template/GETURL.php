<?php

namespace api\templateManagement\template;

use business\auth\Authz;

class GETURL extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->getTemplateServerURL();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username);
    }
}
