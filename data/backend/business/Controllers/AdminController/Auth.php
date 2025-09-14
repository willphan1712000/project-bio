<?php

namespace business\Controllers\AdminController;

use business\Controllers\Handler;
use business\Controllers\User;

class Auth extends Handler
{
    public function doHandle(User $user)
    {
        $user->checkSignedIn();

        return true;
    }
}
