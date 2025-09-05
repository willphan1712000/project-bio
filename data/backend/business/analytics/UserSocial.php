<?php

namespace business\analytics;

use business\IAPI;

class UserSocial extends Analytics implements IAPI
{
    public function execute()
    {
        return $this->getSocial();
    }
}
