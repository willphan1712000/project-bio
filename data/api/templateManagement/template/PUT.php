<?php

namespace api\templateManagement\template;

class PUT extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->put(...$args);
    }

    protected function checkPermission(?string $username = null) {}
}
