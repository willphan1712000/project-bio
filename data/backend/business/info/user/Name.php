<?php

namespace business\info\user;

use business\info\Info;
use business\info\user\User;
use business\info\InfoHandler;
use business\info\display\NormalDisplay;

class Name extends User
{
    function __construct(?InfoHandler $next)
    {
        parent::__construct($next);
        $this->name = 'name';
    }

    public function doHandleUserGET(Info $info): bool
    {
        $value = $this->getValueFromDatabase($this->name, $info->getInfo('username'));
        $display = new NormalDisplay($this->name, $this->format($value));

        $this->checkServerRendering($info, $display);
        return true;
    }

    public function doHandlePush(Info $info): bool
    {
        $value = $info->getInfo($this->name);
        if ($this->validate($this->name, $value)) {
            $info->setInfo('vcard', $info->getInfo('vcard') . 'N;CHARSET=utf-8:' . $this->format($value) . ';;;;\nFN;CHARSET=utf-8:' . $this->format($value) . '\n');
            return $this->setValueToDatabase($this->name, empty($value) ? null : $value, $info->getInfo('username'));
        }
        return false;
    }
}
