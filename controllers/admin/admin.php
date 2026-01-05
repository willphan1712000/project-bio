<?php

namespace controllers\admin;

use business\Controllers\AdminController\Auth;
use business\Controllers\AdminController\Redirect;
use business\Controllers\AdminController\Restore;
use business\Controllers\User;

$user = new User();
$handler = new Auth(
    new Redirect(
        new Restore()
    )
);
$handler->handle($user);

?>

<!-- end of php -->