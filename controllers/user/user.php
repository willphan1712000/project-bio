<?php

use business\Controllers\User;
use business\Controllers\UserController\Deactivate;
use business\Controllers\UserController\Redirect;

// Deactivate -> Redirect
$userHandler = new Deactivate(
    new Redirect()
);

$userHandler->handle(new User());
?>