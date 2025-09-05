<?php

namespace business\analytics;

use business\IAPI;

class GET extends Analytics implements IAPI
{
    public function execute()
    {
        return [
            'totalUser' => $this->getTotalUsers(),
            'totalTemplate' => $this->getTotalTemplate()
        ];
    }
}
