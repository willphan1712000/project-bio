<?php

namespace business\Controllers\UserController;

use business\Controllers\Handler;
use business\Controllers\User;

class Deactivate extends Handler
{
    protected function doHandle(User $user)
    {
        if ($user->isActiveAccount()) return true;

        header("Location: /@deactivate?username=" . $user->get("username"));
        return false;
    }
}
