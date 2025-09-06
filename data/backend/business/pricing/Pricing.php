<?php

namespace business\pricing;

use config\ExternalServices\TemplateServer;
use config\SystemConfig;

class Pricing
{
    protected TemplateServer $otherServer;
    protected string $endpoint;

    public function __construct()
    {
        $this->otherServer = TemplateServer::getInstance();
        $this->endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['pricing'];
    }

    public function get()
    {
        return $this->otherServer->get($this->endpoint);
    }

    public function post($data)
    {
        return $this->otherServer->post($this->endpoint, $data);
    }

    public function put($id)
    {
        return $this->otherServer->put($this->endpoint . "/" . $id);
    }
}
