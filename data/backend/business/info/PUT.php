<?php

namespace business\info;

use business\info\Info;
use business\info\Vcard;

class PUT
{
    private Info $info;

    function __construct(Info $info)
    {
        $this->info = $info;
    }

    private function infoProcess()
    {
        // Handle push to database and create Vcard
        $user = new Vcard(null);

        $userInfoHandler = InfoChainHandler::getInstance($user);

        $this->info->setInfo('vcard', ''); // set vcard string to empty before attaching info elements to it
        return $userInfoHandler->handlePush($this->info);
    }

    public function execute()
    {
        return $this->infoProcess();
    }
}
