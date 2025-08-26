<?php

use business\user\DELETE;
use business\user\POST as UserPOST;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    private $user;
    private $username = 'nhaphan123200';

    public function test()
    {
        $this->user = new UserPOST($this->username, 'phuonganh@gmail.com', 'Phuonganh123200');
        $res = $this->user->execute();
        if (!$res['success']) {
            echo $res['error'];
        }

        $this->assertEquals($res['success'], true);
    }

    protected function tearDown(): void
    {
        echo "Tearing down...";
        $user = new DELETE($this->username);
        $user->execute();
    }
}
