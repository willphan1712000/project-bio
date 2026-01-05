<?php

namespace business\auth;

use api\Request;

interface AuthzInterface
{
    public static function checkPermision(?string $username, ?string $permission = null);
}

class Authz
{
    protected static array $roles = [
        'Allinclicks',
        'user'
    ];
    protected static string $api_prefix = "/api";
    protected static array $user_permission_routes = ['GET:/users', 'POST:/users', "PUT:/users", "DELETE:/users"];

    private function __construct() {}

    /**
     * - Function checks where the given username has right permission
     * - Permission: if Allinclicks, give full permission. If users, check method : route under username
     */
    public static function checkPermision(Request $request)
    {
        $username = $request->getUsername();
        $api_route = $request->getEndpoint();
        $method = $request->getMethod();

        if ($username === null || $api_route === null) return false;

        if ($username === 'Allinclicks') return true;

        if (in_array($method.":".substr($api_route, strlen(self::$api_prefix)), self::$user_permission_routes)) return true;

        return false;
    }
}
