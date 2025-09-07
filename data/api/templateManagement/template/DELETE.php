<?php

namespace api\templateManagement\template;

use api\APIAuth;
use business\auth\Authz;
use business\templateManagement\Template;

class DELETE extends APIAuth
{
    public function handleRequest(...$args)
    {
        $template = new Template();
        return $template->delete(...$args);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "delete:templateserver");
    }
}
