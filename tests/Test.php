<?php

use PHPUnit\Framework\TestCase as FrameworkTestCase;

function testFunc($a, $b)
{
    return $a + $b;
}

class Test extends FrameworkTestCase
{
    public function test1()
    {
        $res = testFunc(5, 10);

        $this->assertEquals($res, 15);
    }
    public function test2()
    {
        $res = testFunc(10, 100);

        $this->assertEquals($res, 110);
    }
    public function test3()
    {
        $res = testFunc(55, 10);

        $this->assertEquals($res, 65);
    }
}
