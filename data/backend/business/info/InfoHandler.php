<?php

namespace business\info;

use business\info\display\DISPLAY_TYPE;
use business\info\display\UserDisplay;
use config\SystemConfig;

abstract class InfoHandler implements InfoElement
{
    private ?InfoHandler $info;
    protected string $name;

    function __construct(?InfoHandler $next)
    {
        $this->info = $next;
    }

    public function handlePush(Info $info): bool
    {
        if (!$this->doHandlePush($info)) {
            return false;
        }
        if ($this->info != null) {
            return $this->info->handlePush($info);
        } else {
            return true;
        }
    }

    public function handleAdminGET(Info $info): bool
    {
        if (!$this->doHandleAdminGET($info)) {
            return false;
        }
        if ($this->info != null) {
            return $this->info->handleAdminGET($info);
        } else {
            return true;
        }
    }

    public function handleUserGET(Info $info): bool
    {
        if (!$this->doHandleUserGET($info)) {
            return false;
        }
        if ($this->info != null) {
            return $this->info->handleUserGET($info);
        } else {
            return true;
        }
    }

    public function doHandlePush(Info $info): bool
    {
        $value = $info->getInfo($this->name);
        if ($this->validate($this->name, $value)) {
            $info->setInfo('vcard', $info->getInfo('vcard') . 'URL;TYPE=' . $this->name . ':' . $this->format($value) . '\n');
            return $this->setValueToDatabase($this->name, empty($value) ? null : $value, $info->getInfo('username'));
        }
        return false;
    }

    public function doHandleAdminGET(Info $info): bool
    {
        $value = $this->getValueFromDatabase($this->name, $info->getInfo('username'));
        $info->setInfo($this->name, $value);
        return true;
    }

    public function doHandleUserGET(Info $info): bool
    {
        $value = $this->getValueFromDatabase($this->name, $info->getInfo('username'));
        $display = new UserDisplay($this->name, $this->format($value));

        $this->checkServerRendering($info, $display);
        return true;
    }

    public function validate($name, $info): bool
    {
        if (empty($info)) {
            return true;
        }
        if (!preg_match(SystemConfig::regexMap()[$name], $info)) {
            throw new \Exception($name . " is not valid");
        }
        return true;
    }

    public function format(?string $info): ?string
    {
        return $info;
    }

    /**
     * This function check if the chosen server rendering is true or not. If true, the info will be used for server rendering, and will be used for client rendering (api call) otherwise
     */
    protected function checkServerRendering(Info $info, UserDisplay $display)
    {
        if ($info->getInfo('is_server_render')) {
            $info->setInfo($this->name, $display);
        } else {
            $info->setInfo($this->name, [
                'value' => $display->getValue(),
                'label' => $display->getLabel(),
                'html' => $display->getHTML(''),
                'htmlWValue' => $display->getHTML($display->getValue()),
                'htmlAdmin' => $display->getHTML(null, DISPLAY_TYPE::ADMIN),
                'htmlAdminWValue' => $display->getHTML($display->getValue(), DISPLAY_TYPE::ADMIN)
            ]);
        }
    }

    protected abstract function getValueFromDatabase(string $getWhat, string $username): ?string;
    protected abstract function setValueToDatabase(string $setWhat, ?string $value, string $username): bool;
}
