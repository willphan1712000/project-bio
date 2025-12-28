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
        try {
            $info = new Info([]);
            $info->setInfo('username', $this->username);

            $userInfoHandler = InfoChainHandler::getInstance(null);

            $get = $userInfoHandler->handleAdminGET($info);

            return [
                'success' => $get,
                'data' => $info->getEntireInfo()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function execute()
    {
        return $this->get();
    }
}
