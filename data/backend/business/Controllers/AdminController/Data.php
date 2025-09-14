<?php

namespace business\Controllers\UserController;

use business\Controllers\Handler;
use business\Controllers\User;

class Data extends Handler
{
    protected function doHandle(User $user)
    {
        $user->fetchData();
        return true;
    }
}
