<?php

namespace core;

use App\Middleware\AuthMiddleware;

class Router {
    private $routes;
    private $protectedRoutes;

    public function __construct($routes) {
        $this->routes = $routes;
        $this->protectedRoutes = $routes['protected'] ?? [];
    }

    public function route() {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Verifica si la ruta está protegida
        if (in_array($url, $this->protectedRoutes)) {
            $authMiddleware = new AuthMiddleware();
            $authMiddleware->handle();
        }

        // Verificar rutas estáticas
        if (isset($this->routes[$method][$url])) {
            $this->dispatch($this->routes[$method][$url]);
            return;
        }

        // Verificar rutas con parámetros
        foreach ($this->routes[$method] as $route => $controllerAction) {
            // Convertir la ruta a un patrón de expresión regular
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            // Intentar hacer coincidir la URL con la ruta dinámica
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Eliminar la coincidencia completa
                $this->dispatch($controllerAction, $matches);
                return;
            }
        }

        // Si no encuentra la ruta
        header('HTTP/1.1 404 Not Found');
        echo json_encode(["error" => "Route not found for method $method: $url"]);
    }

    private function dispatch($controllerAction, $params = []) {
        list($controllerName, $method) = explode('@', $controllerAction);
        $controllerClass = "App\\Controllers\\$controllerName";

        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $method)) {
                // Llamar al método del controlador con los parámetros extraídos
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(["error" => "Method not found in controller: $method"]);
            }
        } else {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(["error" => "Controller class not found: $controllerClass"]);
        }
    }
}
