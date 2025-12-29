<?php

namespace business\info;

use business\info\Info;

/**
 * This class is for getting user information for admin site
 */
class GET
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    private function get()
    {
        $info = new Info([]);
        $info->setInfo('username', $this->username);

        $userInfoHandler = InfoChainHandler::getInstance(null);

        $userInfoHandler->handleAdminGET($info);

        return $info->getEntireInfo();
    }

    public function execute()
    {
        return $this->get();
    }
}
