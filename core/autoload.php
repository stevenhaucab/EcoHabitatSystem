<?php

spl_autoload_register(function ($class) {
    // Verifica si la clase pertenece al namespace "core"
    if (strpos($class, 'core\\') === 0) {
        // Convertir el namespace en una ruta de archivo dentro de la carpeta "core"
        $classPath = dirname(__DIR__, 1) . '/' . str_replace('\\', '/', $class) . '.php';
    } else {
        // Mapeo del namespace raíz "App" con la carpeta "src"
        $prefix = 'App\\';
        $base_dir = dirname(__DIR__, 1) . '/src/';

        // Si la clase pertenece al namespace "App\"
        if (strpos($class, $prefix) === 0) {
            $prefix = 'src\\';
        }

        // Remover el prefix "App\" del namespace
        $relative_class = substr($class, strlen($prefix));

        // Reemplazar las barras invertidas por barras normales y construir la ruta del archivo
        $classPath = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    }

    // Verificar si el archivo existe y cargarlo
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});
