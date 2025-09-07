<?php

namespace api\templateManagement\user;

use api\APIAuth;
use business\templateManagement\TemplateUser;

class GET extends APIAuth
{
    public function handleRequest(...$arg)
    {
        $body = $this->request->getBody();
        $username = $body['username'] ?? $this->getUsername();
        $template_id = $body['template_id'] ?? NULL;

        $userTemplate = new TemplateUser();
        return $userTemplate->get($username, $template_id);
    }

    protected function checkPermission(?string $username = null)
    {
        return true; // publicly accessible
    }
}
