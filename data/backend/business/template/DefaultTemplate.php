<?php
namespace business\template;

use persistence\Database;
use persistence\Entity\User;

/**
 * This class deals with default template every user has currently
 */
class DefaultTemplate {
    /**
     * Get default template from a user
     * @return int default template
     * @throws Exception if username is missing or database access error
     */
    public function get(?string $username = NULL) {
        if ($username === NULL) {
            throw new \Exception("username is missing");
        }

        return Database::GET(User::class, 'defaultTemplate', ['username' => $username]);
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
}