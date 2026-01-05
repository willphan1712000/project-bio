<?php

namespace api;

interface ResponseInterface {
    /**
     * Set status code for the response
     * - 400: Bad request
     * - 401: Unauthorized
     * - 403: Forbidden
     * - 404: Not Found
     * - 405: Method Not Allowed
     * - 409: Conflict
     * @param int status code
     * @return ResponseInterface current Response object
     */
    public function setStatusCode(int $code): ResponseInterface;

    /**
     * Send a json as a response
     * @param array an associative array of data
     * @return ResponseInterface current Response object
     */
    public function json(array $data): ResponseInterface;
}
/**
 * Response should have response status code and data
 */
class Response implements ResponseInterface {

    public function setStatusCode(int $code): ResponseInterface
    {
        http_response_code($code);
        return $this;
    }

    public function json(array $data): ResponseInterface
    {
        header('Access-Control-Allow-Origin');
        header('Content-Type: application/json');
        echo json_encode($data);
        return $this;
    }
}