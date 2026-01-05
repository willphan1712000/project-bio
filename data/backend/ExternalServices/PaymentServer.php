<?php

namespace config\ExternalServices;

use config\APIClient;
use config\SystemConfig;

class PaymentServer implements ExternalServiceInterface
{
    protected APIClient $apiClient;
    protected static PaymentServer $instance;

    private function __construct()
    {
        $api_key = SystemConfig::globalVariables()['payment_server']['api_key'];
        $url = SystemConfig::globalVariables()['payment_server']['url'];

        $this->apiClient = new APIClient(
            api_key: $api_key,
            url: $url
        );
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new PaymentServer();
        }

        return self::$instance;
    }

    public function get(string $endpoint)
    {
        return $this->apiClient->get($endpoint);
    }

    public function post(string $endpoint, mixed $data)
    {
        return $this->apiClient->post($endpoint, $data);
    }

    public function put(string $endpoint, mixed $data = null)
    {
        return $this->apiClient->put($endpoint, $data);
    }
    public function delete(string $endpoint)
    {
        return $this->apiClient->delete($endpoint);
    }
}
