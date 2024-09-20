<?php

namespace App\Controllers;

use core\Controller;
use core\View;

class DesarrollosController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Desarrollos',
            'content' => 'Desarrollos'
        ];

        // Renderizar la vista 'home'
        View::render('desarrollos/index.php', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Agregar Nuevo Desarrollo'
        ];

        // Renderizar la vista 'desarrollos/create.php'
        View::render('desarrollos/formulario.php', $data);
    }
}
