<?php

namespace api;

use config\SystemConfig;

interface RequestInteface {
    /**
     * Set username to Request object
     * @param string|null $username
     */
    public function setUsername(?string $username);

    /**
     * Get username from Request object
     * @return string $username
     */
    public function getUsername();

    /**
     * Set id to Request object - uniquely identified index for data
     * - It could be username, template id, element id, ...
     * - Id will be broken down into elements stored in an array
     * @param null|string $id string of ids such as /username/templateid ...
     */
    public function setId(?string $id);

    /**
     * Get list of id
     * @return array list of id
     */
    public function getId();

    /**
     * Set permisison to Request object
     * @param null|string $permission
     */
    public function setPermission(?string $permission);

    /**
     * Get permission from Request object
     * @return null|string permission
     */
    public function getPermission();

    /**
     * Get secret key possible attached to the request headers
     * @return null|string
     */
    public function getSecretKey();

    /**
     * Get Json web token possibly attached to the request headers
     * @return null|string
     */
    public function getJWT();

    /**
     * Get endpoint from Request object
     * @return string|false endpoint of current request. False when no endpoint is given
     */
    public function getEndpoint();

    /**
     * Get method from Request object
     * @return string request method = GET | POST | PUT | DELETE | ...
     */
    public function getMethod();

    /**
     * Get body from Request object
     * @return array associative array format
     */
    public function getBody();

    /**
     * Get headers from Request object
     * @return array|false request headers. False when no headers
     */
    public function getHeaders();

    /**
     * Get query string from a parameter
     * @return null|string
     */
    public function getQueryString(?string $param);
}
/**
 * Request should have header and body
 */
class Request implements RequestInteface
{
    private ?array $id;
    private ?string $username;
    private ?string $permission;

    public function setUsername(?string $username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setId(?string $id) {
        $this->id = $id !== NULL ? explode("/", $id) : NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function setPermission(?string $permission)
    {
        $this->permission = $permission;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function getJWT() {
        return $this->getHeaders()[SystemConfig::globalVariables()['auth']['token_property']] ?? NULL;
    }

    public function getSecretKey()
    {
        return $this->getHeaders()['secret'] ?? NULL;
    }

    public function getEndpoint()
    {
        return strtok($_SERVER['REQUEST_URI'], "?");
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody()
    {
        return json_decode(file_get_contents("php://input"), true);
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function getQueryString(?string $param) {
        return $param === NULL ? NULL : $_GET[$param];
    }
}