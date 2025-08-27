<?php

use business\template\DELETE;
use business\template\GET;
use business\template\POST;
use PHPUnit\Framework\TestCase;

class TemplateGetTest extends TestCase
{
    private $username = 'nha';
    private $template_id = 100;

    public function test()
    {
        $template = new POST($this->username, $this->template_id);
        $res = $template->execute();

        $get = new GET($this->username);
        $result = $get->execute();

        if (!$result['success']) {
            echo $result['error'];
        }

        $this->assertEquals($result['success'], true);
    }

    protected function tearDown(): void
    {
        $delete = new DELETE($this->username, $this->template_id);
        $delete->execute();
    }
}
