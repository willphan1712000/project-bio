<?php

namespace business\info\display;

/**
 * Handle normal display such as texts
 */
class NormalDisplay extends UserDisplay
{
    function __construct(string $name, ?string $value)
    {
        parent::__construct($name, $value);
    }

    public function getHTML(?string $children = null, DISPLAY_TYPE $display = DISPLAY_TYPE::USER): string
    {
        if ($display === DISPLAY_TYPE::ADMIN) {
            $list = ['name', 'position', 'organization'];
            if (in_array($this->name, $list)) {
                return '<input id="' . $this->name . '" data-name="' . $this->name . '" class="w-full border-none bg-transparent text-center" value="' . ($this->value ?? '') . '" autocomplete="true">'; // Indicator for editting
            }
        }

        return $this->value ?? '';
    }
}
