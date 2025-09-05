<?php

namespace api\templateManagement\template;

class POST extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->post();
    }

    protected function checkPermission(?string $username = null) {}
}
