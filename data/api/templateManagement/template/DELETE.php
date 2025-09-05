<?php

namespace api\templateManagement\template;

class DELETE extends TemplateController
{
    public function handleRequest(...$args)
    {
        return $this->delete(...$args);
    }

    protected function checkPermission(?string $username = null) {}
}
