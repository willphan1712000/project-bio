<?php

namespace api\templateManagement\template;

use api\APIAuth;
use business\auth\Authz;
use business\templateManagement\Template;

class GET extends APIAuth
{

    public function handleRequest(...$args)
    {
        $template = new Template();
        return $template->get(...$args);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "get:templateserver");
    }
}
