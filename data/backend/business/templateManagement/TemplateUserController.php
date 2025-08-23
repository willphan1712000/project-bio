<?php

namespace business\templateManagement;

use api\Request;
use api\Response;
use business\info\GET;
use business\info\userGET;
use business\template\TemplateManagement;
use config\SystemConfig;
use config\TalkToOtherServer;

/**
 * This class handles talking to template server to get all related information on a template a user has already purchased
 */
class TemplateUserController
{
    protected Request $request;
    protected Response $response;
    protected TalkToOtherServer $otherServer;
    protected static string $Template_Server_URL;
    protected static string $info_endpoint;
    protected static string $template_endpoint;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->otherServer = TalkToOtherServer::getInstance();
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$info_endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['info'];
        self::$template_endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['template'];
    }

    /**
     * This function handles getting all template and template information - this might handle efficient loading
     */
    public function post()
    {
        $body = $this->request->getBody();
        $username = $body['username'];
        $template_id = $body['template_id'] ?? NULL;

        // Get user info
        $infoObj = new userGET($username);
        $info = $infoObj->execute();
        if (!$info['success']) {
            return $this->response->setStatusCode(400)->json([
                "success" => false,
                "error" => $info['error']
            ]);
        }

        // Get default template from user
        $id = TemplateManagement::shareTemplate($username, $template_id);

        // Get template from template server
        $template_json = $this->otherServer->get(
            self::$Template_Server_URL . self::$template_endpoint . "/" . $id
        );

        $template_data = json_decode($template_json, true);
        if (!$template_data['success']) {
            return $this->response->setStatusCode(400)->json([
                'success' => false,
                'error' => $template_data['error']
            ]);
        }

        // Get template info from template server
        $template_info_json = $this->otherServer->get(
            self::$Template_Server_URL . self::$info_endpoint . "/" . $id
        );

        $template_info_data = json_decode($template_info_json, true);
        if (!$template_info_data['success']) {
            return $this->response->setStatusCode(400)->json([
                'success' => false,
                'error' => $template_info_data['error']
            ]);
        }

        $this->response->setStatusCode(200)->json([
            "success" => true,
            "data" => [
                "template" => $template_data['data'],
                "template_info" => $template_info_data['data'],
                "template_server_url" => self::$Template_Server_URL,
                "user_info" => $info['data']
            ]
        ]);
    }
}
