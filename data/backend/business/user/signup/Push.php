<?php

namespace business\user\signup;

use business\Controllers\UserLogics\UserManagement;
use business\user\signup\SignupHandler;
use business\user\signup\Input;
use persistence\Entity\User;
use persistence\Entity\UserInfo;
use persistence\Entity\UserPhone;
use persistence\Entity\UserSocial;
use persistence\EntityManager;

class Push extends SignupHandler
{
    function __construct(?SignupHandler $next)
    {
        parent::__construct($next);
    }

    public function doHandle(Input $input): bool
    {
        $entityManager = EntityManager::getEntityManager();

        $username = $input->getUsername();
        $password = $input->getPassword();
        $email = $input->getEmail();

        $user = new User();
        $userInfo = new UserInfo();
        $userPhone = new UserPhone();
        $userSocial = new UserSocial();

        $user->set("username", $username);
        $user->set("password", UserManagement::createHashedPassword($password));
        $user->set("email", $email);
        $user->set('defaultTemplate', 0);

        $userInfo->set("username", $username);
        $userPhone->set("username", $username);
        $userSocial->set("username", $username);

        $entityManager->persist($user);
        $entityManager->persist($userInfo);
        $entityManager->persist($userPhone);
        $entityManager->persist($userSocial);

        $entityManager->flush();

        return true;
    }
}
