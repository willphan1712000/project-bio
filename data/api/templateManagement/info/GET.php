<?php

namespace api\templateManagement\info;

use api\APIAuth;
use business\templateManagement\TemplateInfo;

class GET extends APIAuth
{
    public function handleRequest(...$args)
    {
        $template = new TemplateInfo();
        return $template->get(...$args);
    }

    protected function checkPermission(?string $username = null) {}
}
