<?php

namespace business\Controllers\AdminController;

use business\Controllers\Handler;
use business\Controllers\User;

class Restore extends Handler
{
    public function doHandle(User $user)
    {
        if (!$user->isActiveAccount()) {
            header("Location: /@restore?username=" . $user->get("username"));
            return false;
        }

        return true;
    }
}
