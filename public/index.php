<?php

require_once '../vendor/autoload.php';

$config = require '../config/config.php';
$routes = require '../config/routes.php';

use core\Router;

$router = new Router($routes, $config['jwt_key']);
$router->route();
