<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;

class RegisterController extends Controller
{
    // Mostrar el formulario de registro
    public function showForm()
    {
        View::render('register');
    }

    // Procesar el registro de usuario
    public function store()
    {
        // Verificar si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los valores del formulario
            $name = $_POST['name'] ?? null;
            $user = $_POST['user'] ?? null;
            $password = $_POST['password'] ?? null;
            $idRol = $_POST['idRol'] ?? null;
            $status = $_POST['status'] ?? null;

            // Validar que los campos no estén vacíos
            if (!$name || !$user || !$password || !$idRol || !$status) {
                $this->showFormWithError('Todos los campos son obligatorios.');
                return;
            }

            // Encriptar la contraseña
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Configuración de la conexión a la base de datos
            $dbConfig = [
                'host' => $_ENV['DB_HOST'] ?? 'localhost',
                'port' => $_ENV['DB_PORT'] ?? '3306',
                'dbname' => $_ENV['DB_NAME'] ?? 'cedral_db',
                'user' => $_ENV['DB_USER'] ?? 'root',
                'password' => $_ENV['DB_PASS'] ?? '',
            ];

            try {
                // Conectar a la base de datos
                $db = new Database($dbConfig);
                $conn = $db->connect();

                // Preparar la consulta para insertar el usuario
                $sql = "INSERT INTO users (name, user, password, idRol, status, dateCreation)
                        VALUES (:name, :user, :password, :idRol, :status, NOW())";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':password', $passwordHash);
                $stmt->bindParam(':idRol', $idRol);
                $stmt->bindParam(':status', $status);

                // Ejecutar la consulta
                $stmt->execute();

                // Mostrar mensaje de éxito
                $this->showFormWithSuccess('Usuario registrado exitosamente.');
            } catch (Exception $e) {
                // Mostrar mensaje de error si ocurre algún problema
                $this->showFormWithError('Error al registrar el usuario: ' . $e->getMessage());
            }
        } else {
            // Si no es una solicitud POST, mostrar el formulario de registro
            $this->showForm();
        }
    }

    // Método para mostrar el formulario con un mensaje de error
    private function showFormWithError($error)
    {
        View::render('register', ['error' => $error]);
    }

    // Método para mostrar el formulario con un mensaje de éxito
    private function showFormWithSuccess($success)
    {
        View::render('register', ['success' => $success]);
    }
}
