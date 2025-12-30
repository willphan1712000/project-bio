<?php

namespace business\templateManagement;

use config\ExternalServices\TemplateServer;
use config\SystemConfig;

/**
 * Responsible for Template info management (dimensions ...)
 */
class TemplateInfo
{
    protected TemplateServer $otherServer;
    protected string $endpoint;

    public function __construct()
    {
        $this->otherServer = TemplateServer::getInstance();
        $this->endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['info'];
    }

    public function get($id)
    {
        /**
         * @var array{success: bool, data: array, error: ?string}
         */
        return $this->otherServer->get($this->endpoint . "/" . $id);
    }
}
