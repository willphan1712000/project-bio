<?php

namespace business\user\delete;

use business\user\UserManagement;

class IsUserExist extends DeleteHandler
{
    function __construct(?DeleteHandler $next)
    {
        parent::__construct($next);
    }

    public function doHandle(string $username): bool
    {
        if (!UserManagement::isUserExist($username)) {
            throw new \Exception("User does not exist");
        }
        return true;
    }
}
