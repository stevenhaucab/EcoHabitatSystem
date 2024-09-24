<?php

require_once '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require '../config/config.php';
$routes = require '../config/routes.php';

use core\Router;

$router = new Router($routes, $config['jwt_key']);
$router->route();
