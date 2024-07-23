<?php

namespace src\models;

use PDO;

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Valida las credenciales del usuario.
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function validateUser($username, $password) {
        // Prepara y ejecuta la consulta para verificar el usuario
        $query = 'SELECT * FROM users WHERE username = :username LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }

        return false;
    }
}
