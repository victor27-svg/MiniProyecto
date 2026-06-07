<?php
// Inicializar el cargador automático de clases
require_once 'core/Autoloader.php';

// Capturar la acción de la URL (si está vacía, va al menú de inicio)
$url = $_GET['url'] ?? 'inicio';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <a href="../index.php" class="btn-volver">← Volver al menú</a>
<?php

// Enrutador básico hacia tus funciones del Controlador
use  Src\Controllers\Problemas;
$controller = new Problemas();

switch ($url) {
    case 'problema1':
        $controller->problema1();
        break;
    case 'problema2':
        $controller->problema2();
        break;
    case 'problema3':
        $controller->problema3();
        break;
    case 'problema4':
        $controller->problema4();
        break;
    case 'problema5':
        $controller->problema5();
        break;
    case 'problema6':
        $controller->problema6();
        break;
    case 'problema7':
        $controller->problema7();
        break;
    case 'problema8':
        $controller->problema8();
        break;
    case 'problema9':
        $controller->problema9();
        break;
    case 'inicio':
    default:
        // Carga la pantalla de bienvenida con el menú
        require_once 'views/inicio.php';
        break;
}

// footer
require_once 'views/layouts/footer.php';
?>