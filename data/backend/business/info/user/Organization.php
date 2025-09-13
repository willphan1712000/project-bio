<?php

namespace business\info\user;

use business\info\Info;
use business\info\user\User;
use business\info\InfoHandler;
use business\info\display\NormalDisplay;
use business\info\operation\JobTitle;

class Organization extends User
{
    function __construct(?InfoHandler $next)
    {
        parent::__construct($next);
        $this->name = 'organization';
    }
    public function doHandleUserGET(Info $info): bool
    {
        $value = $this->getValueFromDatabase($this->name, $info->getInfo('username'));
        $display = new NormalDisplay($this->name, $value);

        $this->checkServerRendering($info, $display);
        return true;
    }

    public function handlePush(Info $info): bool
    {
        $value = $info->getInfo($this->name);
        if ($this->validate($this->name, $value)) {
            $info->setInfo('vcard', $info->getInfo('vcard') . 'ORG;CHARSET=utf-8:' . $value . '\n');

            return $this->setValueToDatabase($this->name, empty($value) ? null : $value, $info->getInfo('username'));
        }
        return false;
    }
}
