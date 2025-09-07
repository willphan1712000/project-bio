<?php

namespace business\resources;

use config\SystemConfig;

class Info
{
    public function __construct() {}

    public function get()
    {
        return [
            'regexMap' => SystemConfig::regexMap(),
            'labelMap' => SystemConfig::labelMap(),
            'defaultImg' => SystemConfig::globalVariables()['img']['unknown'],
            'iconMap' => SystemConfig::socialIconArr(),
            'deleteWarning' => SystemConfig::globalVariables()['deleteWarningMsg']
        ];
    }
}
