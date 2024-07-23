<?php
namespace App\Controllers;

use core\Controller;
use src\models\HomeModel;
use core\Database;

class HomeController extends Controller {
    private $model;

    public function __construct() {
        $config = require '../config/config.php';
        $db = new Database($config['db']);
        $this->model = new HomeModel($db->connect());
    }

    public function index() {
        // Procesa la solicitud GET
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->model->setId(1);
            $response = $this->model->getUser();
            if ($response === false) {
                $this->json(['error' => 'Error al obtener el desarrollo']);
            } else {
                $this->json($response);
            }
        }
        // Puedes agregar más lógica aquí para otros métodos HTTP
    }

    public function create() {
        // Procesa la solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Implementa la lógica para manejar POST
        }
    }

    public function update() {
        // Procesa la solicitud PUT
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Implementa la lógica para manejar PUT
        }
    }

    public function delete() {
        // Procesa la solicitud DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Implementa la lógica para manejar DELETE
        }
    }
}
