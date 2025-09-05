<?php

namespace business\auth;

class Authz
{
    protected static array $roles = [
        'Allinclicks',
        'user'
    ];
    protected static array $user_permisions = ['get:user', 'post:user', 'put:user', 'deletehold:user'];

    private function __construct() {}

    /**
     * Function checks where the given username has right permission
     */
    public static function checkPermision(?string $username = null, ?string $permission = null)
    {
        if ($username === null || $permission === null) return false;

        if ($username === 'Allinclicks') return true;

        if (in_array($permission, self::$user_permisions)) return true;

        return false;
    }
}
