<?php

namespace business\info\display;

use business\info\operation\Operation;

interface Display
{
    public function getValue(): ?string;
    public function getLabel(): string;
    public function getHTML(?string $children = null, DISPLAY_TYPE $display = DISPLAY_TYPE::USER): string;
    public function setOperation(Operation $o): Display;
}
