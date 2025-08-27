<?php

namespace business\info\display;

use config\SystemConfig;

class AvatarDisplay extends UserDisplay
{
    function __construct(string $name, ?string $value)
    {
        parent::__construct($name, $value);
    }

    public function getHTML(?string $children = null): string
    {
        $username = SystemConfig::URLExtraction();
        $src = $this->value !== null ? '/user/' . $this->value : SystemConfig::globalVariables()['img']['unknown'];

        return '<img src="' . $src . '" alt="bio_user_avatar" draggable="false" style="width: 100%; height: 100%;" />';
    }
}
