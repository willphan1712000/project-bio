<?php

use component\Back;
use component\Copyright;
use component\BioTemplateButton;
use business\info\display\Display;
use controllers\admin\AdminController;
use controllers\template\TemplateFactory;

$admin = new AdminController(); // get admin object
$username = AdminController::getUsername();

// /** @var Display[] */
// $infoArray = $admin->get("info");

// $themeid = $admin->get("themeid"); // Get themeid
// $css = $admin->get("css"); // Get CSS for corresponding template
// $g = $admin->get("g");
// $image = $infoArray['image']->getHTML() === null || $infoArray['image']->getHTML() === '' ? $g['img']['unknown'] : "/user/" . $username . "/" . $infoArray['image']->getHTML();


// $imgPath = $image;
// $imgName = '';

// This is information that gets passed down to the corresponsing template
// $props = [
//     'username' => $username,
//     'imgPath' => $image,
//     'info' => $infoArray,
//     'css' => $css
// ];

if (isset($_POST['signout'])) {
    unset($_SESSION['username']);
    header("Location: /" . $username);
}
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
        <div id="uploadImagePopup"></div>

        <div id="save" class="max-w-[90%] z-10 cursor-pointer bg-white fixed top-[0.5rem] right-[0.5rem] rounded-[85px]" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
        rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;"></div>

        <div>
            <div class="card-container swiper" style="scrollbar-width: none;">
                <div class="swiper-wrapper">
                    <div id="container" class="front swiper-slide">
                        <div class="face-card-label">Front</div>
                        <div id="container_template"></div>
                        <?php
                        // TemplateFactory::getInstance()->getTemplate($themeid)->html($props);
                        ?>
                    </div>
                    <div class="back swiper-slide">
                        <div class="face-card-label">Back</div>
                        <?php
                        // echo (new Back([
                        //     'container' => '.back',
                        //     'username' => $username,
                        //     'info' => $props['info']
                        // ]))->render();
                        ?>
                    </div>
                </div>
            </div>
            <div id="setting" class="sticky bottom-0 z-[10] w-full"></div>
        </div>
        <div class="bioBtn"><?= (new BioTemplateButton($username))->render(".bioBtn"); ?></div>
        <div class="flex justify-center items-center mt-[10px]">
            <form action="" method="POST">
                <button name="signout" class="ele logout typebox"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
            </form>
        </div>
        <?php (new Copyright([
            'position' => 'relative'
        ]))->render(); ?>
    </div>
</body>

</html>