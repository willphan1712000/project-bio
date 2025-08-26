<?php

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function test()
    {
        $password = 'Phanthanhnha1712000';

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        $correct = password_verify($password, $passwordHashed);

        $this->assertEquals($correct, true);
    }
}
