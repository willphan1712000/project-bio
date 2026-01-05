<?php
require_once __DIR__ . "/data/backend/Error.php";
require_once __DIR__ . "/vendor/autoload.php";
Dotenv\Dotenv::createImmutable("./")->load();
SESSION_START();

use api\APIRouter;
use config\Router;
use config\SystemConfig;

SystemConfig::redirect();
APIRouter::api_work();
Router::router_work();
