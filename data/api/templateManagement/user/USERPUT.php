<?php

namespace api\templateManagement\user;

use api\APIAuth;
use business\auth\Authz;
use business\templateManagement\TemplateUser;

class USERPUT extends APIAuth
{
    public function handleRequest(...$arg)
    {
        $templateUser = new TemplateUser();
        return $templateUser->updateUser(...$arg);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "");
    }
}
