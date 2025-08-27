<?php

namespace business\user\delete;

use business\user\delete\DeleteHandler;
use persistence\Entity\Style;
use persistence\Entity\Template;
use persistence\Entity\User;
use persistence\Entity\UserInfo;
use persistence\Entity\UserPhone;
use persistence\Entity\UserSocial;
use persistence\EntityManager;

class DeleteData extends DeleteHandler
{
    function __construct(?DeleteHandler $next)
    {
        parent::__construct($next);
    }

    public function doHandle(string $username): bool
    {
        try {
            $entityManager = EntityManager::getEntityManager();

            $user = $entityManager->find(User::class, $username);
            $userInfo = $entityManager->find(UserInfo::class, $username);
            $userSocial = $entityManager->find(UserSocial::class, $username);
            $userPhone = $entityManager->find(UserPhone::class, $username);
            $userTemplate = $entityManager->getRepository(Template::class)->findOneBy(["username" => $username]);
            $userStyle = $entityManager->getRepository(Style::class)->findOneBy(["username" => $username]);

            $entityManager->remove($user);
            $entityManager->remove($userInfo);
            $entityManager->remove($userPhone);
            $entityManager->remove($userSocial);
            if ($userTemplate) $entityManager->remove($userTemplate);
            if ($userStyle) $entityManager->remove($userStyle);
            $entityManager->flush();

            return true;
        } catch (\Exception $e) {
            return $e->getMessage() . ". Error: Can not delete user data";
        }
    }
}
