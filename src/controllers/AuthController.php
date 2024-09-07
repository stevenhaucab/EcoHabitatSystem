<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;

class AuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm($error = null)
    {
        // Pasar el error (si existe) a la vista de login
        View::render('login', ['error' => $error]);
    }

    // Procesar el inicio de sesión
    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los valores del formulario
            $user = $_POST['user'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$user || !$password) {
                // Mostrar error si no se proporcionó usuario o contraseña
                $this->showLoginForm('El usuario o la contraseña no fueron proporcionados.');
                return;
            }

            // Configuración de la conexión (puede venir de un archivo .env o config.php)
            $dbConfig = [
                'host' => $_ENV['DB_HOST'] ?? 'localhost',
                'port' => $_ENV['DB_PORT'] ?? '3306',
                'dbname' => $_ENV['DB_NAME'] ?? 'cedral_db',
                'user' => $_ENV['DB_USER'] ?? 'root',
                'password' => $_ENV['DB_PASS'] ?? '',
            ];

            // Conectar a la base de datos usando la clase Database
            try {
                $db = new Database($dbConfig);
                $conn = $db->connect();

                // Consultar si el usuario existe en la base de datos
                $stmt = $conn->prepare('SELECT * FROM users WHERE user = :user LIMIT 1');
                $stmt->bindParam(':user', $user);
                $stmt->execute();
                $userRecord = $stmt->fetch();

                if ($userRecord) {
                    if (password_verify($password, $userRecord['password'])) {
                        // Autenticación exitosa, guardar datos del usuario en la sesión
                        $_SESSION['user'] = [
                            'id' => $userRecord['id'],
                            'name' => $userRecord['name'],
                            'email' => $userRecord['user'],
                            'idRol' => $userRecord['idRol'],
                            'status' => $userRecord['status']
                        ];

                        // Redirigir al usuario a la página de inicio
                        header('Location: /home');
                        exit;
                    } else {
                        // Contraseña incorrecta
                        $this->showLoginForm('Usuario o contraseña incorrectos.');
                    }
                } else {
                    // Usuario no encontrado
                    $this->showLoginForm('Usuario o contraseña incorrectos.');
                }
            } catch (Exception $e) {
                // Mostrar error de conexión a la base de datos
                $this->showLoginForm('Error en la conexión a la base de datos.');
            }
        } else {
            // Si no es una solicitud POST, redirigir al formulario de login
            $this->showLoginForm();
        }
    }

    // Método para cerrar sesión
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
