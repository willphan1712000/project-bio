<?php

namespace api\templateManagement;

use api\APIAuth;
use business\templateManagement\TemplateInfo;

/**
 * This class handles talking to template server to manage template information
 */
abstract class TemplateInfoController extends APIAuth
{
    protected TemplateInfo $templateInfo;

    public function __construct()
    {
        $this->templateInfo = new TemplateInfo();
    }

    /**
     * This function handles getting all template information - this might handle efficient loading
     */
    public function get($id)
    {
        $res = $this->templateInfo->get($id);
        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }
}
