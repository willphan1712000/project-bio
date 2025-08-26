<?php

namespace business\user\signup;

use business\user\UserManagement;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use config\SystemConfig;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;

class CreateQR extends SignupHandler
{
    function __construct(?SignupHandler $next)
    {
        parent::__construct($next);
    }

    public function doHandle(Input $input): bool
    {
        $path = SystemConfig::globalVariables()['user_folder'] . $input->getUsername(); // get path to folder
        $url = UserManagement::URLGenerator($input->getUsername(), "share"); // get url generated for share

        $write = new PngWriter();

        // Create QR Code
        $qrCode = new QrCode(
            data: $url,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        // Create generic logo
        $logo = new Logo(
            path: __DIR__ . '../../../../../../controllers/client/img/logo.png',
            resizeToWidth: 200,
            punchoutBackground: true
        );

        $result = $write->write($qrCode, $logo);

        // Directly output the QR code
        header('Content-Type: ' . $result->getMimeType());

        // Save it to a file
        $result->saveToFile($path . '/qr-code.png');
        return true;
    }
}
