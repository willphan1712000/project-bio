<?php

namespace business\pricing;

use api\Request;
use api\Response;
use config\SystemConfig;
use config\TalkToOtherServer;

class PricingController
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
        self::$endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['pricing'];
    }

    public function get()
    {
        $res = $this->otherServer->get(
            self::$Template_Server_URL . self::$endpoint
        );

        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }

    public function post()
    {
        $data = file_get_contents('php://input');

        $res = $this->otherServer->post(
            self::$Template_Server_URL . self::$endpoint,
            $data
        );

        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }

    public function put($id)
    {
        $res = $this->otherServer->put(
            self::$Template_Server_URL . self::$endpoint . "/" . $id
        );

        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }
}
