<?php

namespace api\templateManagement;

use api\Request;
use api\Response;
use business\info\userGET;
use business\template\TemplateManagement;
use business\templateManagement\Template;
use business\templateManagement\TemplateInfo;

/**
 * This class handles talking to template server to get all related information on a template a user has already purchased
 */
class TemplateUserController
{
    protected Request $request;
    protected Response $response;
    protected Template $template;
    protected TemplateInfo $templateInfo;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->template = new Template();
        $this->templateInfo = new TemplateInfo();
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
            return $this->response->setStatusCode(400)->json($info);
        }

        // Get default template from user
        $id = TemplateManagement::shareTemplate($username, $template_id);

        // Get template from template server
        $template = $this->template->get($id);
        if (!$template['success']) {
            return $this->response->setStatusCode(400)->json($template);
        }

        // Get template info from template server
        $template_info = $this->templateInfo->get($id);
        if (!$template_info['success']) {
            return $this->response->setStatusCode(400)->json($template_info);
        }

        // Template server URL
        $url = $this->template->getTemplateServerURL();

        $this->response->setStatusCode(200)->json([
            "success" => true,
            "data" => [
                "template" => $template['data']['data'],
                "template_info" => $template_info['data']['data'],
                "template_server_url" => $url['data'],
                "user_info" => $info['data']
            ]
        ]);
    }
}
