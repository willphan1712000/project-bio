<?php

namespace business\template;

use persistence\Entity\Template;
use persistence\Entity\User;
use persistence\EntityManager;

class GET
{
    private string $username;

    function __construct(string $username)
    {
        $this->username = $username;
    }

    private function getLikedTemplate()
    {
        try {
            $entityManager = EntityManager::getEntityManager();

            /** @var User|NULL */
            $user = $entityManager->find(User::class, $this->username);

            /** @var Template|NULL */
            $templates = $entityManager->getRepository(Template::class)->findBy(['username' => $this->username]);

            if ($user === NULL) {
                throw new \Exception("user does not exist");
            }

            $out = [];

            foreach ($templates as $template) {
                array_push($out, $template->get('template_id'));
            }

            return [
                'success' => true,
                'data' => $out
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function execute()
    {
        return $this->getLikedTemplate();
    }
}
