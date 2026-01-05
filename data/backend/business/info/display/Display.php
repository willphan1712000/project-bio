<?php

namespace business\info\display;

use business\info\operation\Operation;

interface Display
{
    /**
     * Get actual value (value after being made useful (fotmatted))
     */
    public function getRealValue(): ?string;

    /**
     * Get operated value of the of a current field for how it looks like in the UI
     * - Example: value after being shortened, ...
     */
    public function getValue(): ?string;

    /**
     * get label of a current field
     */
    public function getLabel(): string;

    /**
     *  get html for user or admin
     */
    public function getHTML(?string $children = null, DISPLAY_TYPE $display = DISPLAY_TYPE::USER): string;

    /**
     * set operation that takes effect on a current field
     */
    public function setOperation(Operation $o): Display;
}
