<?php
/**
 * Autoloader PSR-4 automatizado.
 * Mapea el namespace 'Src\\' hacia la carpeta física 'src/'
 */
spl_autoload_register(function ($class) {
    $prefix = 'Src\\';
    $base_dir = __DIR__ . '/../src/';

    // ¿La clase utiliza el prefijo de nuestro namespace?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // No pertenece a nuestro proyecto
    }

    // Obtener el nombre relativo de la clase
    $relative_class = substr($class, $len);

    // Reemplazar separadores de namespace (\) por separadores de carpetas (/)
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo físico existe, lo incluye
    if (file_exists($file)) {
        require_once $file;
    }
});