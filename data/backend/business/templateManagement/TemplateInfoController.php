<?php

namespace business\templateManagement;

use api\Request;
use api\Response;
use config\SystemConfig;
use config\TalkToOtherServer;

/**
 * This class handles talking to template server to manage template information
 */
class TemplateInfoController
{
    protected Request $request;
    protected Response $response;
    protected TalkToOtherServer $otherServer;
    protected static string $Template_Server_URL;
    protected static string $endpoint;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->otherServer = TalkToOtherServer::getInstance();
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['info'];
    }

    /**
     * This function handles getting all template information - this might handle efficient loading
     */
    public function get($id)
    {
        $this->otherServer->get(
            self::$Template_Server_URL . self::$endpoint . "/" . $id,
            function ($res) {
                $this->response->setStatusCode(200)->json([
                    "success" => true,
                    "data" => json_decode($res, true),
                ]);
            },
            function () {
                $this->response->setStatusCode(400)->json([
                    "success" => false,
                    "error" => "There is an error getting information."
                ]);
            }
        );
    }
}
