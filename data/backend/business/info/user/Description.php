<?php

namespace business\info\user;

use business\info\Info;
use business\info\InfoHandler;
use business\info\display\NormalDisplay;
use business\info\operation\TextArea;

class Description extends User
{
    function __construct(?InfoHandler $next)
    {
        parent::__construct($next);
        $this->name = 'description';
    }

    public function doHandleUserGET(Info $info): bool
    {
        $value = $this->getValueFromDatabase($this->name, $info->getInfo('username'));
        $display = new NormalDisplay($this->name, $this->format($value));

        $this->checkServerRendering($info, $display);
        return true;
    }

    public function handlePush(Info $info): bool
    {
        $value = $info->getInfo($this->name);
        if ($this->validate($this->name, $value)) {
            $info->setInfo('vcard', $info->getInfo('vcard') . 'NOTE;CHARSET=utf-8:' . $this->format($value) . '\n');

            return $this->setValueToDatabase($this->name, empty($value) ? null : $value, $info->getInfo('username'));
        }
        return false;
    }

    public function format($info): ?string
    {
        $o = TextArea::getInstance();
        return $o->execute($info);
    }
}
