<?php

namespace config;

interface APIClient_Interface
{
    public function get(string $endpoint, array $headers = []);
    public function post(string $endpoint, mixed $data, array $headers = []);
    public function put(string $endpoint, mixed $data, array $headers = []);
    public function delete(string $endpoint, array $headers = []);
}

class APIClient implements APIClient_Interface
{
    protected ?string $api_key;
    protected string $url;
    protected array $headers;
    protected static string $error_str = 'There is an error communicating to ther other server!';

    public function __construct(string $url, ?string $api_key = null)
    {
        $this->url = $url;
        $this->api_key = $api_key;

        // Initialize connection
        // Create headers that will go along with each request for authentication and authorization
        $this->headers = [
            "Authorization: {$this->api_key}",
            "Content-Type: application/json"
        ];
    }

    public function get(string $endpoint, array $headers = [])
    {
        return $this->call($endpoint, "GET", $headers);
    }

    public function post(string $endpoint, mixed $data, array $headers = [])
    {
        $ch = curl_init($this->url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        $res = curl_exec($ch);

        $isFailed = curl_errno($ch);

        curl_close($ch);

        if ($isFailed) {
            throw new \Exception(self::$error_str);
        }

        return json_decode($res, true);
    }

    public function put(string $endpoint, mixed $data, array $headers = [])
    {
        return $this->call($endpoint, "PUT", $headers);
    }

    public function delete(string $endpoint, array $headers = [])
    {
        return $this->call($endpoint, "DELETE", $headers);
    }

    private function call(string $endpoint, $method, $headers = [])
    {
        $ch = curl_init($this->url . $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        $res = curl_exec($ch);

        $isFailed = curl_errno($ch);

        curl_close($ch);

        if ($isFailed) {
            throw new \Exception(self::$error_str);
        }

        return json_decode($res, true);
    }
}
