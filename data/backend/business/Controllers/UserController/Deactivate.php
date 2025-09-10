<?php

namespace business\Controllers\UserController;

use business\Controllers\User;

class Deactivate extends Handler
{
    protected function doHandle(User $user)
    {
        if ($user->checkDeactivation()) return true;

        header("Location: /@deactivate");
        return false;
    }
}
