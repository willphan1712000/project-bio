<?php

namespace business\templateManagement;

use business\info\userGET;
use business\style\GET;
use business\template\TemplateManagement;
use business\templateManagement\Template;
use business\templateManagement\TemplateInfo;

class TemplateUser
{
    protected Template $template;
    protected TemplateInfo $templateInfo;

    public function __construct()
    {
        $this->template = new Template();
        $this->templateInfo = new TemplateInfo();
    }

    public function get($username, $template_id)
    {
        // Get user info
        $infoObj = new userGET($username);
        $info = $infoObj->execute();
        if (!$info['success']) {
            throw new \Exception($info['error']);
        }

        // Get style info
        $styleObj = new GET($username);
        $style = $styleObj->execute();
        if (!$style['success']) {
            throw new \Exception($style['error']);
        }

        // Get default template from user
        $id = TemplateManagement::shareTemplate($username, $template_id);

        // Get template from template server
        $template = $this->template->get($id);
        if (!$template['success']) {
            throw new \Exception($template['error']);
        }

        // Get template info from template server
        $template_info = $this->templateInfo->get($id);
        if (!$template_info['success']) {
            throw new \Exception($template_info['error']);
        }

        // Template server URL
        $url = $this->template->getTemplateServerURL();

        return [
            "template" => $template['data'],
            "template_info" => $template_info['data'],
            "template_server_url" => $url,
            "user_info" => $info['data'],
            "user_style" => $style['data']
        ];
    }
}
