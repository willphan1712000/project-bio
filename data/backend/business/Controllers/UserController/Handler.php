<?php

namespace business\Controllers\UserController;

use business\Controllers\User;

abstract class Handler
{
    protected ?Handler $next;

    public function __construct(?Handler $next = null)
    {
        $this->next = $next;
    }
    public function handle(User $user)
    {
        if (!$this->doHandle($user)) return;

        if ($this->next !== null) {
            $this->next->handle($user);
        }
    }
    protected abstract function doHandle(User $user);
}
