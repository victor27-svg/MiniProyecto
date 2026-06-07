<?php
namespace Src\Utils;

class Utilidades{
    /**
     * Comprueba si un valor está incluido en una lista permitida.
     * Uso: validar que una opción del usuario pertenezca a valores esperados.
     *
     * @param mixed $valor Valor a verificar
     * @param array $lista_permitida Arreglo con los valores permitidos
     * @return bool True si está presente (comparación estricta), false en caso contrario
     */
    public static function validarEnLista($valor, $lista_permitida){
        return in_array($valor, $lista_permitida, true);
    }

    /**
     * Retorna el valor si existe, o un valor por defecto en caso contrario.
     * Evita avisos por variables no definidas y actúa como un COALESCE simple.
     *  
     */
    public static function nvl(&$var, $default = ''){
        return isset($var) ? $var : $default;
    }

    /**
     * Valida el token CSRF recibido por POST comparándolo con el token en sesión.
     * Inicia la sesión si aún no existe y usa hash_equals para evitar timing attacks.
     */
    public static function validarCSRF(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        // Compara el token enviado con el token almacenado en sesión
        if (isset($_POST['csrf_token']) && isset($_SESSION['csrf_token'])){
            return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
        }
        return false; // Token no válido o no presente
    }

    /**
     * Genera (si no existe) y devuelve el token CSRF almacenado en sesión.
     * Utiliza random_bytes para asegurar entropía criptográfica.
     *
     * @return string Token CSRF en hexadecimal
     */
    public static function generarCSRF(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (empty($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * PROBLEMA 9:
     * Utilidades de cálculo y filtrado:
     * - calcularPotencia: realiza pow(base, exponente).
     * - filtrarEntero: valida y devuelve un entero o false.
     * - filtrarFlotante: valida y devuelve un float o false.
     */
    public static function calcularPotencia($base, $exponente){
        return pow($base, $exponente);
    }
    public static function filtrarEntero($valor){
        return filter_var($valor, FILTER_VALIDATE_INT);
    }
    public static function filtrarFlotante($valor){
        return filter_var($valor, FILTER_VALIDATE_FLOAT);
    }

    /**
     * PROBLEMA 5: Clasificación de Edades
     * Clasifica un array de edades en rangos y delega la generación
     * del HTML estadístico a `generarEstadistica`.
     *
     */
    public static function designarEdad(array $edades){
        $niños = 0;
        $adolescentes = 0;
        $adultos = 0;
        $ancianos = 0;

        foreach ($edades as $edad) {
            //  VALIDACIÓN SEGURA (OWASP A03 / A04)
            if ($edad === false || $edad === null || $edad < 0 || $edad > 120) {
                continue;// ignora valores inválidos
            }

            if ($edad >= 0 && $edad <= 12) {
                $niños++;
            } elseif ($edad >= 13 && $edad <= 17) {
                $adolescentes++;
            } elseif ($edad >= 18 && $edad <= 64) {
                $adultos++;
            } else {
                $ancianos++;
            }
        }

        $rangoEdad = [$niños, $adolescentes, $adultos, $ancianos];
        return self::generarEstadistica($edades, $rangoEdad);
    }

    /**
     * PROBLEMA 7: Calcula estadísticas de un conjunto de notas (máxima, mínima, promedio, desviación)
     * Genera una cadena HTML con estadísticas (total, promedio, min, max),
     * frecuencia por edad y una simple representación por rangos. */
    public static function generarEstadistica(array $edades, array $rangoEdad){

    //  Seguridad: validar array vacío
        if (empty($edades)) {
            return '<p>No hay datos para mostrar</p>';
        }

        $tamaño = count($edades);
        $promedio = round(array_sum($edades) / $tamaño, 2);
        $maxEdad = max($edades);
        $minEdad = min($edades);
        $cantidades = array_count_values($edades);

        $estadistica = "
        <div class='resultados'>
            <h3>Resultados Estadísticos</h3>
            <div class='tarjetas'>
                <div class='tarjeta'>
                    <h5>Total Personas</h5>
                    <p>" . htmlspecialchars($tamaño) . "</p>
                </div>
                <div class='tarjeta'>
                    <h5>Promedio</h5>
                    <p>" . htmlspecialchars($promedio) . "</p>
                </div>
                <div class='tarjeta'>
                    <h5>Edad Máxima</h5>
                    <p>" . htmlspecialchars($maxEdad) . "</p>
                </div>
                <div class='tarjeta'>
                    <h5>Edad Mínima</h5>
                    <p>" . htmlspecialchars($minEdad) . "</p>
                </div>
            </div>
            <h4>Frecuencia de Edades</h4>
        ";
          //  OWASP: evitar XSS
        foreach ($cantidades as $edad => $cantidad) {
            $estadistica .= "
            <div class='frecuencia-item'>
                <span>Edad " . htmlspecialchars($edad) . "</span>
                <span>" . htmlspecialchars($cantidad) . " persona(s)</span>
            </div>
            ";
        }

        $tipos = [
            'Niños',
            'Adolescentes',
            'Adultos',
            'Ancianos/Adultos Mayores'
        ];
        $contador = 0;
        $estadistica .= '<h4>Gráfica por Rangos de Edad</h4>';

        foreach ($rangoEdad as $rango) {
            $ancho = $rango * 100;
            $nombreTipo = $tipos[$contador];
            $estadistica .= "
            <div class='barra-contenedor'>
                <div class='barra-titulo'>" . htmlspecialchars($nombreTipo) . " ($rango)</div>
                <div class='barra-fondo'>
                    <div class='barra' style='width: {$ancho}px'>
                        $rango persona(s)
                    </div>
                </div>
            </div>
            ";
            $contador++;
        }

        $estadistica .= '</div>';
        return $estadistica;
    }

    /*
     * Crea y devuelve un fragmento HTML con campos <input> para ingresar notas.
     * Se utiliza para generar dinámicamente el HTML de envío de notas.
     */
    public static function crearCampos($cantidad){
    $cantidad = (int)$cantidad;
    $campo = "";

    for($i = 0; $i < $cantidad; $i++){
        $nombre = 'nota' . $i;
        $campo .= "
        <div class='mb-3'>
            <label class='form-label'>Ingrese su Nota</label>
            <input type='number' name='$nombre' id='$nombre' 
                   min='0' max='100' step='0.01'
                   class='form-control' required>
        </div>
        ";
    }

    $campo .= "
    <input type='hidden' name='totalNotas' id='totalNotas' value='$cantidad'>
    <button type='submit' class='btn btn-primary w-100'>Enviar Notas</button>";

    return $campo;
}

    /**
     * PROBLEMA 7: Notas Seguras
     * Calcula estadísticas (máxima, mínima, promedio, desviación muestral)
     * para un conjunto de notas y devuelve un bloque HTML con el resultado.
     * Realiza validaciones básicas y aborta con `die()` si detecta datos fuera
     * de rango (comportamiento deliberado para la práctica).
     **/
    public static function calcularNotas($notas, $cant){
        $cant = (int)$cant;

        if($cant <= 0){
            die('Error de seguridad: cantidad inválida');
        }

        $maxNota = 0;
        $minNota = 100;
        $promNota = 0;

        foreach($notas as $nota){
            $nota = (float)$nota;

            // OWASP A01: validación estricta
            if($nota < 0 || $nota > 100){
                die('Dato inválido detectado (OWASP A01)');
            }
            if($nota > $maxNota){
                $maxNota = $nota;
            }
            if($nota < $minNota){
                $minNota = $nota;
            }
            $promNota += $nota;
        }

        $promNota = $promNota / $cant;

        // Desviación estándar (segura)
        $suma = 0;

        foreach($notas as $nota){
            $suma += pow($nota - $promNota, 2);
        }

        $deviacion = ($cant > 1) ? sqrt($suma / ($cant - 1)) : 0;

        // OWASP A03: escape de salida
        return "
        <div class='resultado'>
            <h3>Resultado</h3>
            <p>Nota máxima: " . htmlspecialchars($maxNota) . "</p>
            <p>Nota mínima: " . htmlspecialchars($minNota) . "</p>
            <p>Promedio: " . htmlspecialchars(number_format($promNota, 2)) . "</p>
            <p>Desviación estándar: " . htmlspecialchars(number_format($deviacion, 2)) . "</p>
        </div>";
    }

    /**
     * PROBLEMA 8: Limpieza de Datos
     * Sanitiza una cadena aplicando trim() y htmlspecialchars() para evitar XSS.
     *
     */
    public static function limpiarDato($dato){
         // OWASP A03: evita XSS y entradas peligrosas
        return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
    }

    public static function validarFecha($fecha){
        $formato = 'Y-m-d';
        $d = \DateTime::createFromFormat($formato, $fecha);

        // valida formato real de fecha
        return $d && $d->format($formato) === $fecha;
    }

    public static function obtenerEstacion($fecha){
        if (!self::validarFecha($fecha)) {
            return 'Fecha inválida';
        }

        $mes = date('m', strtotime($fecha));
        $dia = date('d', strtotime($fecha));

        if ((($mes == 12) && ($dia >= 21)) || ($mes == 1) || ($mes == 2) || (($mes == 3) && ($dia <= 20))) {
            return 'Verano';
        }

        if ((($mes == 3) && ($dia >= 21)) || ($mes == 4) || ($mes == 5) || (($mes == 6) && ($dia <= 21))) {
            return 'Otoño';
        }

        if ((($mes == 6) && ($dia >= 22)) || ($mes == 7) || ($mes == 8) || (($mes == 9) && ($dia <= 22))) {
            return 'Invierno';
        }

        return 'Primavera';
    }
}