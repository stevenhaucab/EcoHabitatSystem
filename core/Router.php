<?php

namespace core;

use App\Middleware\JwtMiddleware;

class Router {
    private $routes;
    private $protectedRoutes;
    private $key;

    public function __construct($routes, $key) {
        $this->routes = $routes;
        $this->key = $key;
        $this->protectedRoutes = $routes['protected'] ?? [];
    }

    public function route() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Verifica el token para rutas protegidas
        if (in_array($url, $this->protectedRoutes)) {
            $jwtMiddleware = new JwtMiddleware($this->key);
            $jwtMiddleware->handle();
        }

        // Verifica si la ruta y el método existen
        if (isset($this->routes[$method][$url])) {
            $controllerAction = $this->routes[$method][$url];
            list($controllerName, $method) = explode('@', $controllerAction);

            $controllerClass = "App\\controllers\\$controllerName";
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method();
                } else {
                    header('HTTP/1.1 404 Not Found');
                    echo json_encode(["error" => "Method not found in controller: $method"]);
                }
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(["error" => "Controller class not found: $controllerClass"]);
            }
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(["error" => "Route not found for method $method: $url"]);
        }
    }
}
