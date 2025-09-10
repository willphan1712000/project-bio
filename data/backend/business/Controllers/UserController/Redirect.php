<?php

namespace business\Controllers\UserController;

use business\Controllers\User;

class Redirect extends Handler
{
    protected function doHandle(User $user)
    {
        $themeid = $user->get("template_id");

        if ($themeid === 0) {
            require __DIR__ . "/../../../../../dist/userDefault.php";
            return false;
        }

        require __DIR__ . "/../../../../../dist/userTemplate.php";
        return false;
    }
}
