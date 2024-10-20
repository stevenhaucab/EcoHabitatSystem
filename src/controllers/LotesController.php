<?php

namespace App\Controllers;

use core\Controller;
use core\View;
use core\Database;
use Exception;
use src\models\LotesModel;


class LotesController extends Controller
{
    private $conn;

    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $db = new Database($config['db']);
        $this->conn = $db->connect();
    }

    // Mostrar la lista de lotes, opcionalmente filtrando por desarrollo
    public function index($idDesarrollo = null)
    {
        try {
            $etapaModel = new LotesModel($this->conn);

            // Obtener las lotes, filtrando por idDesarrollo si se proporciona
            $lotes = $etapaModel->getLotesWithDesarrollos($idDesarrollo);

            // Si se proporciona idDesarrollo, obtener el nombre del desarrollo
            $title = 'Todas las Lotes';
            if ($idDesarrollo) {
                $desarrolloName = $etapaModel->getDesarrolloNameById($idDesarrollo);
                if ($desarrolloName) {
                    $desarrolloName = strtoupper($desarrolloName);
                    $title = "Lotes del Desarrollo: $desarrolloName";
                } else {
                    $title = "Lotes del Desarrollo: No encontrado";
                }
            }

            $data = ['title' => $title, 'lotes' => $lotes];
            View::render('lotes/index.php', $data);
        } catch (Exception $e) {
            echo 'Error al obtener las lotes: ' . $e->getMessage();
        }
    }

    // Mostrar el formulario para agregar una nueva etapa
    public function create()
    {
        $etapaModel = new LotesModel($this->conn);

        // Obtener los desarrollos
        $desarrollos = $etapaModel->getAllDesarrollos();

        View::render('lotes/formulario.php', [
            'title' => 'Agregar Nueva Lote',
            'desarrollos' => $desarrollos
        ]);
    }

    // Mostrar el formulario para editar una etapa existente
    public function edit($id)
    {
        try {
            $etapaModel = new LotesModel($this->conn);
            $etapa = $etapaModel->getLoteById($id);

            if (!$etapa) {
                throw new Exception("Lote no encontrada");
            }

            // Obtener los desarrollos
            $desarrollos = $etapaModel->getAllDesarrollos();

            View::render('lotes/formulario.php', [
                'title' => 'Editar Lote',
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
            $nombreLote = $_POST['nombreLote'] ?? null;
            $idDesarrollo = $_POST['idDesarrollo'] ?? null; // Nuevo campo
            $status = 1; // Predeterminado

            if (!$nombreLote || !$idDesarrollo) {
                $this->showFormWithError('Todos los campos son obligatorios.');
                return;
            }

            try {
                $etapaModel = new LotesModel($this->conn);
                $etapaModel->insertLote($nombreLote, $status, $idDesarrollo); // Pasar el idDesarrollo
                $this->showFormWithSuccess('Lote guardada exitosamente.');
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
            $nombreLote = $_POST['nombreLote'] ?? null;
            $idDesarrollo = $_POST['idDesarrollo'] ?? null; // Nuevo campo
            $status = $_POST['status'] ?? 1;

            if (!$nombreLote || !$idDesarrollo) {
                $this->showFormWithError('Todos los campos son obligatorios.', 'Editar Lote');
                return;
            }

            try {
                $etapaModel = new LotesModel($this->conn);
                $etapaModel->updateLote($id, $nombreLote, $status, $idDesarrollo); // Pasar el idDesarrollo
                $this->showFormWithSuccess('Lote actualizada exitosamente.', 'Editar Lote', $id);
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

        // Redirigir al index de lotes
        header('Location: /lotes');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }

    private function showFormWithSuccess($success)
    {
        // Guardar el mensaje de éxito en una variable de sesión temporalmente
        $_SESSION['success'] = $success;

        // Redirigir al index de lotes
        header('Location: /lotes');
        exit; // Asegurarse de que el script no continúe ejecutándose
    }
}
