<?php

// Cargar el autoload manual
require_once __DIR__ . '/../core/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cargar las rutas desde un archivo de configuración
$routes = require_once __DIR__ . '/../config/routes.php';

// Iniciar el router
$router = new core\Router($routes);
$router->route();
