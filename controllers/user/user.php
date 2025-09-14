<?php

use business\Controllers\User;
use business\Controllers\UserController\Deactivate;
use business\Controllers\UserController\Init;
use business\Controllers\UserController\Redirect;

// Init -> Deactivate -> Redirect
$userHandler = new Init(
    new Deactivate(
        new Redirect()
    )
);

$userHandler->handle(new User());

?>

<!-- end of php -->