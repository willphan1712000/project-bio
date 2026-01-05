<?php

namespace business\Controllers\AdminController;

use business\Controllers\Handler;
use business\Controllers\User;

class Redirect extends Handler
{
    public function doHandle(User $user)
    {
        if (!$user->get("isSignedIn")) {
            header("Location: /@signin");
            return false;
        }

        if ($user->get("username") === 'Allinclicks') {
            require __DIR__ . "/../../../../../dist/aic.php";
            return false;
        }

        if ($user->get("template_id") === 0) {
            require __DIR__ . "/../../../../../dist/adminDefault.php";
        } else {
            require __DIR__ . "/../../../../../dist/adminTemplate.php";
        }

        return true;
    }
}
