<?php

namespace business\template;

use persistence\Entity\Template;
use persistence\Entity\User;
use persistence\EntityManager;

class POST
{
    private string $username;
    private int $template_id;

    function __construct(string $username, int $template_id)
    {
        $this->username = $username;
        $this->template_id = $template_id;
    }

    private function addLikedTemplate()
    {
        try {
            $entityManager = EntityManager::getEntityManager();

            $template = new Template();
            $template->set("username", $this->username);
            $template->set("template_id", $this->template_id);

            /** @var User $user */
            $user = $entityManager->find(User::class, $this->username);
            if ($user === NULL) {
                throw new \Exception("user does not exist");
            }

            $entityManager->persist($template);
            $entityManager->flush();

            return [
                'success' => true
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
        return $this->addLikedTemplate();
    }
}
