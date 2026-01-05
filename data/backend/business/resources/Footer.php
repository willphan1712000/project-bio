<?php

namespace business\resources;

use business\user\UserManagement;
use config\SystemConfig;
use persistence\Entity\User;
use persistence\EntityManager;

class Footer {
    public function __construct() {}

    /**
     * Getting footer information
     * - share URL
     * - save contact url
     * - qr URL
     * @throws Exception If user does not exist
     * @return array
     */
    public function get(string $username)
    {
        $entityManager = EntityManager::getEntityManager();
        $user = $entityManager->find(User::class, $username);

        if($user === NULL) {
            throw new \Exception('user does not exist');
        }
        
        return [
            'shareURL' => UserManagement::URLGenerator($username, "share"),
            'vcardURL' => SystemConfig::globalVariables()['absolute_user_folder'].$username.'/vcard.php',
            'qrCodeURL' => SystemConfig::globalVariables()['absolute_user_folder'].$username.'/qr-code.png'
        ];
    }
}
