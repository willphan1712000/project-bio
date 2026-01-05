<?php

namespace business\Controllers\UserController;

use business\Controllers\Handler;
use business\Controllers\User;

class Init extends Handler
{
    protected function doHandle(User $user)
    {
        $user->iniUser();
        return true;
    }
}
