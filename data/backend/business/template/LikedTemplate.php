<?php
namespace business\template;

use persistence\Database;
use persistence\Entity\Template;
use persistence\Entity\User;
use persistence\EntityManager;

/**
 * This class deals with templates that a user likes during shopping
 */
class LikedTemplate {
    /**
     * Get liked templates from a user
     * @return array
     * @throws Exception if username is missing or database access error
     */
    public function get(?string $username = NULL) {
        if ($username === NULL) {
            throw new \Exception("username is missing");
        }
        $entityManager = EntityManager::getEntityManager();

        /** @var User|NULL */
        $user = $entityManager->find(User::class, $username);

        /** @var Template|NULL */
        $templates = $entityManager->getRepository(Template::class)->findBy(['username' => $username]);

        if ($user === NULL) {
            throw new \Exception("user does not exist");
        }

        $out = [];

        foreach ($templates as $template) {
            array_push($out, $template->get('template_id'));
        }

        return $out;
    }

    /**
     * Update default template for a user
     * @return bool if update success
     * @throws Exception if either username or template is missing or database access error
     */
    public function put(?string $username = NULL, ?int $template_id = NULL) {
        if($username === NULL || $template_id === NULL) {
            throw new \Exception("either username or template_id is missing");
        }

        return Database::PUT(User::class, 'defaultTemplate', $template_id, [
                    'username' => $username
        ]);
    }

    /**
     * Add a liked template from a user
     * @return bool
     * @throws Exception if either username or template_id is missing or database access error
     */
    public function post(?string $username = NULL, ?int $template_id = NULL) {
        if($username === NULL || $template_id === NULL) {
            throw new \Exception("either username or template_id is missing");
        }

        $entityManager = EntityManager::getEntityManager();

        $template = new Template();
        $template->set("username", $username);
        $template->set("template_id", $template_id);

        /** @var User $user */
        $user = $entityManager->find(User::class, $username);
        if ($user === NULL) {
            throw new \Exception("user does not exist");
        }

        $entityManager->persist($template);
        $entityManager->flush();

        return true;
    }

    /**
     * Delete a liked template from a user
     * @return bool
     * @throws Exception if either username or template_id is missing or database access error
     */
    public function delete(string $username, int $template_id) {
        if($username === NULL || $template_id === NULL) {
            throw new \Exception("either username or template_id is missing");
        }

        return Database::DELETE(Template::class, [
                    'username' => $username,
                    'template_id' => $template_id
        ]);
    }
}