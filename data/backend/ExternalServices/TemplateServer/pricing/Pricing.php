<?php

namespace config\ExternalServices\TemplateServer\pricing;

use config\ExternalServices\TemplateServer;
use config\SystemConfig;
use Exception;

class Pricing
{
    protected TemplateServer $otherServer;
    protected string $endpoint;

    public function __construct()
    {
        $this->otherServer = TemplateServer::getInstance();
        $this->endpoint = SystemConfig::globalVariables()['template_server']['endpoint']['pricing'];
    }

    /**
     * Get all pricings
     * @return array{price: float, discount: int, period: int, isRucurring: bool}[]
     */
    public function get()
    {
        /**
         * @var array{success: false, data: array, error: ?string}
         */
        $result = $this->otherServer->get($this->endpoint);

        $status = $result['success'];

        if(!$status) {
            throw new \Exception($result['error']);
        }

        return $result['data'];
    }

    /**
     * Add a new pricing
     * @return bool
     * @throws Exception if there is an error with other server
     */
    public function post($data)
    {
        /**
         * @var array{success: bool, error: ?string}
         */
        $result = $this->otherServer->post($this->endpoint, $data);
        if(!$result['success']) {
            throw new \Exception($result['error']);
        }

        return $result['success'];
    }

    /**
     * Modify pricing
     * @return bool
     * @throws Exception if there is an error with other server
     */
    public function put($id)
    {
        /**
         * @var array{success: bool, error: ?string}
         */
        $result = $this->otherServer->put($this->endpoint . "/" . $id);
        if(!$result['success']) {
            throw new \Exception($result['error']);
        }

        return $result['success'];
    }
}
