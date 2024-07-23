<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtMiddleware {
    private $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function handle() {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
            try {
                // Decodifica el token usando la clave y el algoritmo HS256
                JWT::decode($token, new Key($this->key, 'HS256'));
                // Token válido, permite la solicitud
                return true;
            } catch (Exception $e) {
                // Token inválido o expirado
                header('HTTP/1.1 401 Unauthorized');
                echo json_encode(['error' => 'Invalid or expired token']);
                exit;
            }
        } else {
            // No se proporcionó token
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Authorization header missing']);
            exit;
        }
    }
}
