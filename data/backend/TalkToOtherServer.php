<?php

namespace config;

class TalkToOtherServer
{
    protected static TalkToOtherServer $instance;

    private function __construct() {}

    private function headers(): array
    {
        return SystemConfig::globalVariables()['template_server']['headers'];
    }

    public static function getInstance(): TalkToOtherServer
    {
        if (!isset(self::$instance)) {
            self::$instance = new TalkToOtherServer();
        }

        return self::$instance;
    }

    /**
     * This function handles getting or talking to other servers to get data from them
     * @param string $url endponint from other server
     * @param array $headers possible headers attached to a request. If not specified, it will use the default headers defined in SystemConfig
     */
    public function get(string $url, array $headers = [])
    {
        return $this->call($url, "GET", $headers);
    }

    public function getId() {}

    public function post(string $url, $data, array $headers = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());
        }

        $res = curl_exec($ch);

        $isFailed = curl_errno($ch);

        curl_close($ch);

        if (!$isFailed) {
            return [
                'success' => true,
                'data' => json_decode($res, true)
            ];
        }

        return [
            'success' => false,
            'error' => 'There is an error communicating to the other server.'
        ];
    }

    public function put(string $url, array $headers = [])
    {
        return $this->call($url, "PUT", $headers);
    }

    public function delete(string $url, array $headers = [])
    {
        return $this->call($url, "DELETE", $headers);
    }

    private function call($url, $method, $headers)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());
        }

        $res = curl_exec($ch);

        $isFailed = curl_errno($ch);

        curl_close($ch);

        if (!$isFailed) {
            return [
                'success' => true,
                'data' => json_decode($res, true)
            ];
        }

        return [
            'success' => false,
            'error' => 'There is an error communicating to ther other server!'
        ];
    }
}
