<?php

namespace business\info\display;

use business\info\operation\MakeSpace;
use business\info\operation\Operation;
use business\info\operation\LongString;

enum DISPLAY_TYPE: string
{
    case ADMIN = "ADMIN";
    case USER = "USER";
}

class UserDisplay implements Display
{
    protected string $name;
    protected ?string $value;
    protected ?Operation $o;

    function __construct(string $name, ?string $value)
    {
        $this->name = $name;
        $this->value = $value;
        $this->o = null;
    }

    public function getRealValue(): ?string
    {
        return $this->value;
    }

    public function getValue(): ?string
    {
        $o = LongString::getInstance();
        return $o->execute($this->value);
    }

    public function getLabel(): string
    {
        // Implement the method logic here
        $o = MakeSpace::getInstance();
        return $o->execute($this->name);
    }

    public function getHTML(?string $children = null, DISPLAY_TYPE $display = DISPLAY_TYPE::USER): string
    {
        if ($display === DISPLAY_TYPE::USER) {
            $children = $children ?? $this->value;
            $display = $this->value === null ? "none" : "flex";
            $value = ($this->o === null) ? $this->value : $this->o->execute($this->value);
            return '<a href="' . $value . '" target="_blank" style="align-items: center; width: 100%; height: 100%; text-decoration: none; display: ' . $display . ';">' . $children . '</a>';
        }

        $children = $children ?? '';
        return '<div id="' . $this->name . '" data-name="' . $this->name . '" style="cursor: pointer; display: flex; align-items: center; width: 100%; height: 100%;">' . $children . '</div>'; // Indicator for editting
    }

    public function setOperation(Operation $o): Display
    {
        $this->o = $o;
        return $this;
    }
}
