<?php

namespace core;

class View {
    public static function render($view, $data = []) {
        // Convierte cada clave del array de datos en una variable
        extract($data);

        // Incluye el archivo de vista
        $filePath = __DIR__ . '/../src/views/' . $view . '.php';
        if (file_exists($filePath)) {
            require $filePath;
        } else {
            echo "View not found: " . $view;
        }
    }
}
