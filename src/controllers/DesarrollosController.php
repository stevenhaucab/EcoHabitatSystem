<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;
use src\models\DesarrolloModel;

class DesarrollosController extends Controller
{
    private $conn;

    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $db = new Database($config['db']);
        $this->conn = $db->connect();
    }

    // Mostrar la lista de desarrollos
    public function index()
    {
        try {
            $desarrolloModel = new DesarrolloModel($this->conn);
            $desarrollos = $desarrolloModel->getAllDesarrollos();
            $data = ['title' => 'Desarrollos', 'desarrollos' => $desarrollos];
            View::render('desarrollos/index.php', $data);
        } catch (Exception $e) {
            echo 'Error al obtener los desarrollos: ' . $e->getMessage();
        }
    }

    // Mostrar el formulario para agregar o editar un desarrollo
    public function create()
    {
        View::render('desarrollos/formulario.php', ['title' => 'Agregar Nuevo Desarrollo']);
    }

    // Mostrar el formulario para editar un desarrollo existente
    public function edit($id)
    {
        try {
            $desarrolloModel = new DesarrolloModel($this->conn);
            $desarrollo = $desarrolloModel->getDesarrolloById($id);

            if (!$desarrollo) {
                throw new Exception("Desarrollo no encontrado");
            }

            View::render('desarrollos/formulario.php', [
                'title' => 'Editar Desarrollo',
                'desarrollo' => $desarrollo
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Procesar la creación de un nuevo desarrollo
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreDesarrollo = $_POST['nombreDesarrollo'] ?? null;
            $status = 1; // Predeterminado

            if (!$nombreDesarrollo) {
                $this->showFormWithError('El nombre del desarrollo es obligatorio.');
                return;
            }

            try {
                $desarrolloModel = new DesarrolloModel($this->conn);
                $desarrolloModel->insertDesarrollo($nombreDesarrollo, $status);
                $this->showFormWithSuccess('Desarrollo guardado exitosamente.');
            } catch (Exception $e) {
                $this->showFormWithError('Error al guardar el desarrollo: ' . $e->getMessage());
            }
        } else {
            $this->create();
        }
    }

    // Procesar la actualización de un desarrollo existente
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreDesarrollo = $_POST['nombreDesarrollo'] ?? null;
            $status = $_POST['status'] ?? 1;

            if (!$nombreDesarrollo) {
                $this->showFormWithError('El nombre del desarrollo es obligatorio.');
                return;
            }

            try {
                $desarrolloModel = new DesarrolloModel($this->conn);
                $desarrolloModel->updateDesarrollo($id, $nombreDesarrollo, $status);
                $this->showFormWithSuccess('Desarrollo actualizado exitosamente.');
            } catch (Exception $e) {
                $this->showFormWithError('Error al actualizar el desarrollo: ' . $e->getMessage());
            }
        } else {
            $this->edit($id);
        }
    }

    private function showFormWithError($error)
    {
        View::render('desarrollos/formulario.php', ['error' => $error]);
    }

    private function showFormWithSuccess($success)
    {
        View::render('desarrollos/formulario.php', ['success' => $success]);
    }
}
