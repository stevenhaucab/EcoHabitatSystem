<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;
use src\models\EtapasModel;


class EtapasController extends Controller
{
    private $conn;

    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $db = new Database($config['db']);
        $this->conn = $db->connect();
    }

    // Mostrar la lista de etapas, opcionalmente filtrando por desarrollo
    public function index($idDesarrollo = null)
    {
        try {
            $etapaModel = new EtapasModel($this->conn);

            // Obtener las etapas, filtrando por idDesarrollo si se proporciona
            $etapas = $etapaModel->getEtapasWithDesarrollos($idDesarrollo);

            // Si se proporciona idDesarrollo, obtener el nombre del desarrollo
            $title = 'Todas las Etapas';
            if ($idDesarrollo) {
                $desarrolloName = $etapaModel->getDesarrolloNameById($idDesarrollo);
                if ($desarrolloName) {
                    $desarrolloName = strtoupper($desarrolloName);
                    $title = "Etapas del Desarrollo: $desarrolloName";
                } else {
                    $title = "Etapas del Desarrollo: No encontrado";
                }
            }

            $data = ['title' => $title, 'etapas' => $etapas];
            View::render('etapas/index.php', $data);
        } catch (Exception $e) {
            echo 'Error al obtener las etapas: ' . $e->getMessage();
        }
    }

    // Mostrar el formulario para agregar una nueva etapa
    public function create()
    {
        $etapaModel = new EtapasModel($this->conn);

        // Obtener los desarrollos
        $desarrollos = $etapaModel->getAllDesarrollos();

        View::render('etapas/formulario.php', [
            'title' => 'Agregar Nueva Etapa',
            'desarrollos' => $desarrollos
        ]);
    }

    // Mostrar el formulario para editar una etapa existente
    public function edit($id)
    {
        try {
            $etapaModel = new EtapasModel($this->conn);
            $etapa = $etapaModel->getEtapaById($id);

            if (!$etapa) {
                throw new Exception("Etapa no encontrada");
            }

            // Obtener los desarrollos
            $desarrollos = $etapaModel->getAllDesarrollos();

            View::render('etapas/formulario.php', [
                'title' => 'Editar Etapa',
                'etapa' => $etapa,
                'desarrollos' => $desarrollos
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreEtapa = $_POST['nombreEtapa'] ?? null;
            $idDesarrollo = $_POST['idDesarrollo'] ?? null; // Nuevo campo
            $status = 1; // Predeterminado

            if (!$nombreEtapa || !$idDesarrollo) {
                $this->showFormWithError('Todos los campos son obligatorios.');
                return;
            }

            try {
                $etapaModel = new EtapasModel($this->conn);
                $etapaModel->insertEtapa($nombreEtapa, $status, $idDesarrollo); // Pasar el idDesarrollo
                $this->showFormWithSuccess('Etapa guardada exitosamente.');
            } catch (Exception $e) {
                $this->showFormWithError('Error al guardar la etapa: ' . $e->getMessage());
            }
        } else {
            $this->create();
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombreEtapa = $_POST['nombreEtapa'] ?? null;
            $idDesarrollo = $_POST['idDesarrollo'] ?? null; // Nuevo campo
            $status = $_POST['status'] ?? 1;

            if (!$nombreEtapa || !$idDesarrollo) {
                $this->showFormWithError('Todos los campos son obligatorios.', 'Editar Etapa');
                return;
            }

            try {
                $etapaModel = new EtapasModel($this->conn);
                $etapaModel->updateEtapa($id, $nombreEtapa, $status, $idDesarrollo); // Pasar el idDesarrollo
                $this->showFormWithSuccess('Etapa actualizada exitosamente.', 'Editar Etapa', $id);
            } catch (Exception $e) {
                $this->showFormWithError('Error al actualizar la etapa: ' . $e->getMessage());
            }
        } else {
            $this->edit($id);
        }
    }


    private function showFormWithError($error)
    {
        // Guardar el error en una variable de sesión temporalmente
        $_SESSION['error'] = $error;

        // Redirigir al index de etapas
        header('Location: /etapas');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }

    private function showFormWithSuccess($success)
    {
        // Guardar el mensaje de éxito en una variable de sesión temporalmente
        $_SESSION['success'] = $success;

        // Redirigir al index de etapas
        header('Location: /etapas');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }
}
