<?php

namespace business\user\activation;

use business\IAPI;
use persistence\Database;
use persistence\Entity\User;

class GET implements IAPI
{
    protected ?string $username;

    public function __construct(?string $username = null)
    {
        $this->username = $username;
    }

    private function getDeleteToken()
    {
        try {
            $deleteToken = Database::GET(User::class, 'deleteToken', ['username' => $this->username]) ?? NULL;
            return $deleteToken;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function execute()
    {
        return $this->getDeleteToken();
    }
}
