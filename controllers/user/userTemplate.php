<?php

use business\Controllers\User;
use component\Copyright;
use component\UserFooter;

$username = (new User())->get("username");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $username; ?></title>
    <script src="https://kit.fontawesome.com/960d33c629.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="container"></div>
    <div id="userFooter">
        <?php
        (new UserFooter())->render("#userFooter");
        ?>
    </div>
    <?php (new Copyright([
        'position' => 'relative'
    ]))->render(); ?>
</body>

</html>