<?php

namespace business\resources;

use config\SystemConfig;

class Info
{
    public function __construct() {}

    public function getUserInfoResources()
    {
        try {
            return [
                'success' => true,
                'data' => [
                    'regexMap' => SystemConfig::regexMap(),
                    'labelMap' => SystemConfig::labelMap(),
                    'defaultImg' => SystemConfig::globalVariables()['img']['unknown'],
                    'iconMap' => SystemConfig::socialIconArr()
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getDeleteWarning()
    {
        try {
            return [
                'success' => true,
                'data' => [
                    'deleteWarning' => SystemConfig::globalVariables()['deleteWarningMsg'],
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
