<?php

namespace business\templateManagement;

use config\SystemConfig;
use config\TalkToOtherServer;

class TemplateInfo
{
    protected TalkToOtherServer $otherServer;
    protected static string $Template_Server_URL;
    protected static string $endpoint;

    public function __construct()
    {
        $this->otherServer = TalkToOtherServer::getInstance();
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['info'];
    }

    public function get($id)
    {
        $res = $this->otherServer->get(
            self::$Template_Server_URL . self::$endpoint . "/" . $id
        );

        return $res;
    }
}
