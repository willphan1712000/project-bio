<?php

namespace api\templateManagement\template;

use api\APIAuth;
use business\auth\Authz;
use business\templateManagement\Template;

class POST extends APIAuth
{
    public function handleRequest(...$args)
    {
        $template = new Template();
        return $template->post();
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "post:templateserver");
    }
}
