<?php

namespace business\style;

use persistence\Database;
use persistence\Entity\User;
use persistence\Entity\Style;

class PUT
{
    protected string $username;
    protected int $template;
    protected array $props;

    function __construct(string $username, array $props)
    {
        $this->username = $username;
        $this->template = Database::GET(User::class, 'defaultTemplate', ['username' => $this->username]);
        $this->props = $props;
    }

    protected function updateStyle()
    {
        foreach ($this->props as $element => $values) {
            foreach ($values as $value_key => $value) {
                Database::PUT(Style::class, $value_key, $value, [
                    'username' => $this->username,
                    'template_id' => $this->template,
                    'element' => $element
                ]);
            }
        }

        return true;
    }

    public function execute()
    {
        return $this->updateStyle();
    }
}
