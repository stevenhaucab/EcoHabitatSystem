<?php

namespace App\Middleware;

class AuthMiddleware {

    public function handle() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica si el usuario está autenticado
        if (!isset($_SESSION['user'])) {
            // Redirige al usuario a la página de inicio de sesión si no está autenticado
            header('Location: /login');
            exit;
        }

        // El usuario está autenticado, permite continuar
        return true;
    }
}
