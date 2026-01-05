<?php

use component\Copyright;
use config\SystemConfig;

$g = SystemConfig::globalVariables();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $g['adminTitle']; ?></title>
    <script src="https://kit.fontawesome.com/960d33c629.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="admin">
        <div id="container"></div>
        <?php (new Copyright([
            'position' => 'relative'
        ]))->render(); ?>
    </div>
</body>

</html>