<?php

namespace business\user\signup;

use business\Controllers\UserLogics\UserManagement;
use business\user\signup\SignupHandler;

class Auth extends SignupHandler
{
    function __construct(?SignupHandler $next)
    {
        parent::__construct($next);
    }

    public function doHandle(Input $input): bool
    {
        UserManagement::auth($input->getUsername(), $input->getPassword());
        return true;
    }
}
