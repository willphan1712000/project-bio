<?php

namespace api\templateManagement;

use api\Request;
use api\Response;
use business\templateManagement\Template;
use config\SystemConfig;

/**
 * This class handles talking to template server to manage templates
 */
class TemplateController
{
    protected Request $request;
    protected Response $response;
    protected static string $Template_Server_URL;
    protected static string $endpoint;
    protected Template $template;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        self::$Template_Server_URL = SystemConfig::globalVariables()['template_server']['url'];
        self::$endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['template'];
        $this->template = new Template();
    }

    /**
     * This function handles getting all templates - this might handle efficient loading
     */
    public function get()
    {
        $res = $this->template->get();
        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }

    /**
     * This function handles getting a specific template - this might handle efficient loading
     */
    public function getId($id)
    {
        $res = $this->template->get($id);
        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }

    /**
     * This function handles returning the template server url
     */
    public function getTemplateServerURL()
    {
        $res = $this->template->getTemplateServerURL();
        $this->response->setStatusCode(200)->json($res);
    }

    /**
     * This function handles uploading template to the template server
     */
    public function post()
    {
        // Check for all required files
        $requiredFiles = ['thumbnail', 'template', 'annotation'];
        foreach ($requiredFiles as $field) {
            if (!isset($_FILES[$field])) {
                $return = [
                    "success" => false,
                    "error" => "Missing file: $field."
                ];
                $this->response->setStatusCode(400)->json($return);
                return;
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

        $ch = curl_init(self::$Template_Server_URL . self::$endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $return = [
                "success" => false,
                "error" => "There is an error uploading the files: " . curl_error($ch)
            ];
            $this->response->setStatusCode(500)->json($return);
        } else {
            $return = [
                "success" => true,
                "data" => json_decode($res, true)
            ];
            $this->response->setStatusCode(201)->json($return);
        }

        curl_close($ch);
    }

    /**
     * This function handles changing some information on the template server
     * @param int id id of a template to be updated
     */
    public function put($id)
    {
        $res = $this->template->put($id);
        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }

    /**
     * This function handles deleting a specific template with id
     * @param int id id of a template to be deleted
     */
    public function delete($id)
    {
        $res = $this->template->delete($id);
        if (!$res['success']) {
            return $this->response->setStatusCode(400)->json($res);
        }

        return $this->response->setStatusCode(200)->json($res);
    }
}
