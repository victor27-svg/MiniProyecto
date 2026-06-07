<?php

namespace Src\Utils;

class Security 
{
    /**
     * Sanitiza cadenas de texto para prevenir ataques XSS.
     * 
     */
    public static function sanitize(mixed $data): string 
    {
        if (is_array($data)) {
            return ''; // O procesar el arreglo si fuera necesario
        }
        return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Valida si una entrada es un número entero positivo.
     * 
     */
    public static function validateIntPositive(mixed $value): int|false 
    {
        $filtered = filter_var($value, FILTER_VALIDATE_INT);
        if ($filtered !== false && $filtered > 0) {
            return $filtered;
        }
        return false;
    }
}