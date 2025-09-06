<?php

namespace business\templateManagement;

use config\ExternalServices\TemplateServer;
use config\SystemConfig;

class TemplateInfo
{
    protected TemplateServer $otherServer;
    protected string $Template_Server_URL;
    protected string $endpoint;

    public function __construct()
    {
        $this->otherServer = TemplateServer::getInstance();
        $this->Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        $this->endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['info'];
    }

    public function get($id)
    {
        return $this->otherServer->get($this->endpoint . "/" . $id);
    }
}
