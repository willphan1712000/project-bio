<?php

namespace business\info\display;

use config\SystemConfig;

/**
 * Handle dislaying avatar in user page
 */
class AvatarDisplay extends UserDisplay
{
    function __construct(string $name, ?string $value)
    {
        parent::__construct($name, $value);
    }

    public function getHTML(?string $children = null, DISPLAY_TYPE $display = DISPLAY_TYPE::USER): string
    {
        $src = $this->value !== null ? '/user/' . $this->value : SystemConfig::globalVariables()['img']['unknown'];

        return '<img data-name="image" src="' . $src . '" alt="bio_user_avatar" draggable="false" style="width: 100%; height: 100%;" />';
    }
}
