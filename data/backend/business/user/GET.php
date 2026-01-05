<?php
// 
namespace business\user;

use persistence\Database;
use persistence\Entity\User;

class GET
{
    private ?string $username;
    private ?int $offset;
    private ?int $limit;
    private ?string $like;

    /**
     * @param null|string $username possible specific username
     * @param null|int $offset how many records we like to ignore until desired records
     * @param null|int $limit how many records we like to retrieve
     * @param null|string $like perform pattern matching
     */
    function __construct(?string $username = null, ?int $offset = 0, ?int $limit = null, ?string $like = '')
    {
        $this->username = $username;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->like = $like;
    }

    /**
     * @return array{success: true, data: mixed}
     */
    private function getUser(): array
    {
        if ($this->username === null) {
            if ($this->like !== null || $this->offset !== null || $this->limit !== null) {
                $like = $this->like . "%";
                $offset = $this->offset;
                $limit = $this->limit;
                $r = Database::SQL("SELECT *FROM User WHERE username LIKE '$like' OR email LIKE '$like' LIMIT $limit OFFSET $offset");

                return [
                    'success' => true,
                    'data' => $r
                ];
            }

            $users = Database::GET(User::class);
            $out = [];
            foreach ($users as $user) {
                $row = [];

                foreach (User::getProperty() as $prop) {
                    if (!in_array($prop, ['UserInfo', 'UserPhone', 'UserSocial', 'Template', 'Purchase', 'Style', 'StyleDefault'])) {
                        $row[$prop] = $user->get($prop);
                    }
                }

                array_push($out, $row);
            }

            return [
                'success' => true,
                'data' => $out
            ];
        }

        $user = Database::GET(User::class, null, [
            'username' => $this->username
        ]);

        if ($user === null) {
            throw new \Exception("user does not exist");
        }

        $row = [];

        foreach (User::getProperty() as $prop) {
            if (!in_array($prop, ['UserInfo', 'UserPhone', 'UserSocial', 'Template', 'Purchase', 'Style', 'StyleDefault'])) {
                $row[$prop] = $user->get($prop);
            }
        }

        return $row;
    }

    /**
     * Execution
     * @return array{success: true, data: mixed}
     * @throws \Exeception SQL error or Database management driver issue
     */
    public function execute(): array
    {
        return $this->getUser();
    }
}
