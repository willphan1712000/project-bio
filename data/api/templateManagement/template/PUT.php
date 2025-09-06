<?php

namespace api\templateManagement\template;

use api\APIAuth;
use business\auth\Authz;
use business\templateManagement\Template;

class PUT extends APIAuth
{
    public function handleRequest(...$args)
    {
        $template = new Template();
        return $template->put(...$args);
    }

    protected function checkPermission(?string $username = null)
    {
        return Authz::checkPermision($username, "put:templateserver");
    }
}
