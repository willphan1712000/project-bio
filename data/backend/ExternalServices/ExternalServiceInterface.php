<?php

namespace config\ExternalServices;

interface ExternalServiceInterface
{
    public function get(string $endpoint);
    public function post(string $endpoint, mixed $data);
    public function put(string $endpoint, mixed $data);
    public function delete(string $endpoint);
}
