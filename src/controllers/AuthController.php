<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use core\Controller;
use src\models\UserModel;
use core\Database;

class AuthController extends Controller {
    private $key;
    private $userModel;

    public function __construct() {
        $config = require '../config/config.php';
        $this->key = $config['jwt_key'];

        // Conectar a la base de datos
        $db = new Database($config['db']);
        $this->userModel = new UserModel($db->connect());
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($this->userModel->validateUser($username, $password)) {
            $payload = [
                'iss' => 'your-issuer',
                'iat' => time(),
                'exp' => time() + 3600, // Expiración en 1 hora
                'username' => $username,
            ];

            // Genera el token JWT
            $jwt = JWT::encode($payload, $this->key, 'HS256');
            echo json_encode(['token' => $jwt]);
        } else {
            echo json_encode(['error' => 'Invalid credentials']);
        }
    }
}
