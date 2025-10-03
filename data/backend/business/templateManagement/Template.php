<?php

namespace business\templateManagement;

use config\ExternalServices\TemplateServer;
use config\SystemConfig;

/**
 * Responsible for Template management
 */
class Template
{
    protected TemplateServer $otherServer;
    protected string $Template_Server_URL;
    protected string $endpoint;

    public function __construct()
    {
        $this->otherServer = TemplateServer::getInstance();
        $this->Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        $this->endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['template'];
    }

    public function getTemplateServerURL()
    {
        return $this->Template_Server_URL;
    }

    public function get($id = NULL)
    {
        $id = $id ? "/" . $id : '';
        $res = $this->otherServer->get($this->endpoint . $id);

        return $res;
    }

    public function post()
    {
        // Check for all required files
        $requiredFiles = ['thumbnail', 'template', 'annotation'];
        foreach ($requiredFiles as $field) {
            if (!isset($_FILES[$field])) {
                throw new \Exception("Missing file: $field.");
            }
        }

        $postFields = [
            'thumbnail' => new \CURLFile(
                $_FILES['thumbnail']['tmp_name'],
                mime_content_type($_FILES['thumbnail']['tmp_name']),
                $_FILES['thumbnail']['name']
            ),
            'template' => new \CURLFile(
                $_FILES['template']['tmp_name'],
                mime_content_type($_FILES['template']['tmp_name']),
                $_FILES['template']['name']
            ),
            'annotation' => new \CURLFile(
                $_FILES['annotation']['tmp_name'],
                mime_content_type($_FILES['annotation']['tmp_name']),
                $_FILES['annotation']['name']
            ),
        ];

        $ch = curl_init($this->Template_Server_URL . $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception("There is an error uploading the files: " . curl_error($ch));
        } else {
            $res = json_decode($res, true);
        }

        curl_close($ch);

        return $res;
    }

    public function put($id)
    {
        $res = $this->otherServer->put($this->endpoint . "/" . $id);

        return $res;
    }

    public function delete($id)
    {
        $res = $this->otherServer->delete($this->endpoint . "/" . $id);

        return $res;
    }
}
