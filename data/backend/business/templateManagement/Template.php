<?php

namespace business\templateManagement;

use config\SystemConfig;
use config\TalkToOtherServer;

class Template
{
    protected TalkToOtherServer $otherServer;
    protected static string $Template_Server_URL;
    protected static string $endpoint;

    public function __construct()
    {
        $this->otherServer = TalkToOtherServer::getInstance();
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['template'];
    }

    public function getTemplateServerURL()
    {
        return [
            'success' => true,
            'data' => self::$Template_Server_URL
        ];
    }

    public function get($id = NULL)
    {
        $id = $id ? "/" . $id : '';
        $res = $this->otherServer->get(
            self::$Template_Server_URL . self::$endpoint . $id
        );

        return $res;
    }

    public function put($id)
    {
        $res = $this->otherServer->put(
            self::$Template_Server_URL . self::$endpoint . "/" . $id
        );

        return $res;
    }

    public function delete($id)
    {
        $res = $this->otherServer->delete(
            self::$Template_Server_URL . self::$endpoint . "/" . $id
        );

        return $res;
    }
}
