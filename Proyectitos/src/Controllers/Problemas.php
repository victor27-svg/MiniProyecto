<?php

namespace Src\Controllers;
use Src\Utils\Utilidades;

class Problemas{

/**
     * PROBLEMA 1: Media, Desviación, Min y Max (5 valores)
     */
public function problema1(){
        $numerosValidados = [];
        $media = null;
        $desviacion = null;
        $minimo = null;
        $maximo = null;
        $csrfToken = Utilidades::generarCSRF();
        $csrfError = '';
        $errorValidacion = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utilidades::validarCSRF()){
                $csrfError = 'Solicitud inválida. Intente nuevamente.';
            } else {
            $entradas = $_POST['num'] ?? [];
            $huboError = false;

            // Procesamos cada número con los métodos exigidos
            foreach ($entradas as $valor) {

             // 1. SANITIZACIÓN (OWASP XSS)
                $sanitizado = Utilidades::limpiarDato($valor);

            // 2. VALIDACIÓN (Comprobar si es un número decimal o entero positivo)
                $numero = filter_var($sanitizado, FILTER_VALIDATE_FLOAT);

                if ($numero !== false && $numero > 0) {
                    $numerosValidados[] = $numero;
                } else {
                    $huboError = true;
                    break;
                }
            }

            if ($huboError || count($numerosValidados) !== 5) {
                $errorValidacion = 'Todos los campos deben contener números positivos válidos (enteros o decimales). Evite usar letras o símbolos especiales.';
            }

            if (!$huboError && count($numerosValidados) === 5) {
                // OPERACIONES MATEMÁTICAS
                $minimo = min($numerosValidados);
                $maximo = max($numerosValidados);
                $suma = array_sum($numerosValidados);
                $media = $suma / 5;
                 // Cálculo de la Desviación Estándar Muestral
                $sumaCuadrados = 0;
                foreach ($numerosValidados as $x) {
                    $sumaCuadrados += pow($x - $media, 2);
                }
                $desviacion = sqrt($sumaCuadrados / (5 - 1));// Fórmula muestral (N-1)
            }
            }
        }

        require_once 'views/problemas/problema1.php';
    }

      /**
     * PROBLEMA 2: Suma por Rangos
     */
    
    public function problema2(){
        $resultadoFinal = null;
        $numInicio = null;
        $numFin = null;
        $csrfToken = Utilidades::generarCSRF();
        $csrfError = '';
        $errorValidacion = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utilidades::validarCSRF()){
                $csrfError = 'Solicitud inválida. Intente nuevamente.';
            } else {
            
            // MÉTODOS DE LA PROFESORA (Sanitización con htmlspecialchars)
            $inicioLimpio = Utilidades::limpiarDato($_POST['inicio'] ?? '');
            $finLimpio = Utilidades::limpiarDato($_POST['fin'] ?? '');

             // MÉTODOS DE LA PROFESORA (Validación con filter_var)
            $numInicio = filter_var($inicioLimpio, FILTER_VALIDATE_INT);
            $numFin = filter_var($finLimpio, FILTER_VALIDATE_INT);

            // ESTRUCTURA DE CONTROL: If para validar que sean números correctos y que el inicio sea menor que el fin
            if ($numInicio !== false && $numFin !== false && $numInicio > 0 && $numFin >= $numInicio) {
                $acumulador = 0;
                $i = $numInicio;
                while ($i <= $numFin) {
                    $acumulador += $i;
                    $i++;
                }
                $resultadoFinal = $acumulador;
            } else {
                $errorValidacion = 'Por favor ingrese números enteros positivos y que el número final sea mayor o igual al número inicial.';
            }
            }
        }

        require_once 'views/problemas/problema2.php';
    }

        /**
     * PROBLEMA 3: Múltiplos de 4
     */
   
      public function problema3(){
        $miArregloResultados = [];
        $mensajeAnalisis = '';
        $n = null;
        $csrfToken = Utilidades::generarCSRF();
        $csrfError = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utilidades::validarCSRF()){
                $csrfError = 'Solicitud inválida. Intente nuevamente.';
            } else {
                $entradaLimpia = Utilidades::limpiarDato($_POST['cantidad'] ?? '');
                $n = filter_var($entradaLimpia, FILTER_VALIDATE_INT);

                if ($n !== false && $n > 0) {
                    // ESTRUCTURA DE CONTROL: Bucle FOR para rellenar el arreglo matemáticamente
                    for ($i = 1; $i <= $n; $i++) {
                        $bolsaMultiplos[$i] = 4 * $i; // Almacena el múltiplo indexado en el Arreglo
                    }

                     // ESTRUCTURA DE CONTROL: SWITCH / CASE para dar un mensaje dinámico según el tamaño de N
                    switch (true) {
                        case ($n <= 5):
                            $mensajeAnalisis = "Muestra pequeña optimizada.";
                            break;
                        case ($n > 5 && $n <= 15):
                            $mensajeAnalisis = "Muestra estándar solicitada.";
                            break;
                        default:
                            $mensajeAnalisis = "Procesamiento masivo de múltiplos.";
                            break;
                    }
                } else {
                    $error = 'Por favor ingrese un número entero estrictamente positivo mediante el teclado.';
                }
            }
        } 

        require_once 'views/problemas/problema3.php';
    } 
    /**
     * PROBLEMA 4: Pares e Ímpares (1 al 200)
     */

    public function problema4(){
        $sumaPares = 0;
        $sumaImpares = 0;
        
        for($i = 1; $i <= 200; $i++){
            if($i % 2 == 0){
                $sumaPares += $i;
            } else {
                $sumaImpares += $i;
            }
        }

        require_once 'views/problemas/problema4.php';

    }

       

    /**
     * PROBLEMA 5: Clasificación por edades
     */
    public function problema5(){
        $estadistica = '';
        $csrfToken = Utilidades::generarCSRF();
        $csrfError = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (!Utilidades::validarCSRF()){
                $csrfError = 'Solicitud inválida. Intente nuevamente.';
            } else {
            $edades = [
                filter_input(INPUT_POST, 'edad1', FILTER_VALIDATE_INT),
                filter_input(INPUT_POST, 'edad2', FILTER_VALIDATE_INT),
                filter_input(INPUT_POST, 'edad3', FILTER_VALIDATE_INT),
                filter_input(INPUT_POST, 'edad4', FILTER_VALIDATE_INT),
                filter_input(INPUT_POST, 'edad5', FILTER_VALIDATE_INT),
            ];

            $valido = true;
            foreach ($edades as $edad) {
                if ($edad === false || $edad === null || $edad < 0 || $edad > 120) {
                    $estadistica = 'Error: Edad inválida detectada (0-120).';
                    $valido = false;
                    break;
                }
            }

            if ($valido) {
                $estadistica = Utilidades::designarEdad($edades);
            }
            }
        }

        require_once 'views/problemas/problema5.php';
    }

     /**
     * PROBLEMA 6: Presupuesto Hospitalario
     */


     public function problema6()
    {
        $error = null;
        $resultados = null;
        $csrfToken = Utilidades::generarCSRF();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utilidades::validarCSRF()) {
                $error = "Solicitud inválida. Intente nuevamente.";
            } else {
                // Capturamos, limpiamos espacios y cambiamos comas por puntos en un solo flujo directo
                $montoR = trim($_POST['presupuesto'] ?? '');
                $montoR = str_replace(',', '.', $montoR);

                // Pasamos el string preparado directamente al filtro de la utilidad
                $monto = Utilidades::filtrarFlotante($montoR);

                if ($monto !== false && $monto > 0) {
                    $resultados = [
                        'ginecologia' => $monto * 0.40,
                        'traumatologia' => $monto * 0.35,
                        'pediatria' => $monto * 0.25,
                        'total' => $monto
                    ];
                } else {
                    $error = "Por favor, ingrese un monto válido.";
                }
            }
        }

        require_once 'views/problemas/problema6.php';
    }

    /**
     * PROBLEMA 7: Notas Seguras
     */
    public function problema7(){
        $campos = '';
        $resultado = '';
        $cant = 0;
        $csrfToken = Utilidades::generarCSRF();
        $csrfError = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (!Utilidades::validarCSRF()){
                $resultado = 'Solicitud inválida. Intente nuevamente.';
            } else {
            /* OWASP A01: Validación estricta de cantidad */
            if (isset($_POST['cantidad'])){
                $cant = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT, [
                    'options' => ['min_range' => 2, 'max_range' => 50]
                ]);

                if ($cant === false){
                    $resultado = 'Cantidad inválida.';
                } else {
                    $campos = Utilidades::crearCampos($cant);
                }
            /* OWASP A08: Control de manipulación */
            } elseif (isset($_POST['totalNotas'])){
                $cant = filter_input(INPUT_POST, 'totalNotas', FILTER_VALIDATE_INT, [
                    'options' => ['min_range' => 2, 'max_range' => 50]
                ]);

                if ($cant === false){
                    $resultado = 'Datos manipulados detectados.';
                } else {
                    $notas = [];
                    for ($i = 0; $i < $cant; $i++){
                        $nombre = 'nota' . $i;
                        $nota = filter_input(INPUT_POST, $nombre, FILTER_VALIDATE_FLOAT);

                        if ($nota === false || $nota < 0 || $nota > 100){
                            $resultado = 'Nota inválida detectada (OWASP A01).';
                            break;
                        }

                        $notas[] = $nota;
                    }

                    if ($resultado === ''){
                        $resultado = Utilidades::calcularNotas($notas, $cant);
                    }
                }
            }
            }
        }

        require_once 'views/problemas/problema7.php';
    }


    /**
     * PROBLEMA 8: Estación del Año
     */
    public function problema8(){

        $error = '';
        $estacion = '';
        $csrfToken = Utilidades::generarCSRF();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (!Utilidades::validarCSRF()){
                $error = 'Solicitud inválida. Intente nuevamente.';
            } elseif (isset($_POST['fecha'])){
                $fecha = Utilidades::limpiarDato($_POST['fecha']);

                if (!Utilidades::validarFecha($fecha)){
                    $error = 'Fecha inválida detectada.';
                } else {
                    $estacion = Utilidades::obtenerEstacion($fecha);
                }
            }
        }

        require_once 'views/problemas/problema8.php';
    }

/**
 *  PROBLEMA 9: Potencias (1 al 9)
 */

public function problema9(){
    $error = null;
    $potencias = [];
    $base = null;
    $csrfToken = Utilidades::generarCSRF();

    //Usamos NVL para evaluar de forma segura
    $metodo = Utilidades::nvl($_SERVER['REQUEST_METHOD'], 'GET');   

    if ($metodo === 'POST'){
        if (!Utilidades::validarCSRF()){
            $error = "Solicitud inválida. Intente nuevamente.";
        } else {
            //Capturamos la base usando NVL para evitar errores de variables no definidas
            $baseR = Utilidades::nvl($_POST['base'], null);

            //Filtramos el entero a traves de la utilidad
            $base = Utilidades::filtrarEntero($baseR);

            if($base !== false && $base >=1 && $base <= 9){
                for($exponente = 1; $exponente <= 15; $exponente++){
                    //La operacion matematica No esta expuesta directamente en la vista, sino que se calcula aqui y se pasa el resultado a la vista, siguiendo el principio de separacion de responsabilidades.
                    $potencias[$exponente] = Utilidades::calcularPotencia($base, $exponente);
                }
            }else {
                $error = "Por favor, ingrese un número entero entre 1 y 9.";
            }
        }
    }
    require_once 'views/problemas/problema9.php';
    }

    
}