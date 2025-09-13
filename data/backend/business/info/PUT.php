<?php

namespace business\info;

use business\IAPI;
use business\info\Info;
use business\info\Vcard;

class PUT implements IAPI
{
    private Info $info;

    function __construct(Info $info)
    {
        $this->info = $info;
    }

    private function infoProcess()
    {
        try {
            // Handle push to database and create Vcard
            $user = new Vcard(null);

            $userInfoHandler = InfoChainHandler::getInstance($user);

            $this->info->setInfo('vcard', ''); // set vcard string to empty before attaching info elements to it
            $userInfoSuccess = $userInfoHandler->handlePush($this->info);

            return [
                'success' => $userInfoSuccess
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
        return $this->infoProcess();
    }
}
