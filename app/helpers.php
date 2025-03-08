<?php

if (!function_exists('formatear_moneda')) {
    function formatear_moneda($numero, $decimales = 2, $separadorDecimal = ',', $separadorMiles = '.')
    {
        return number_format($numero, $decimales, $separadorDecimal, $separadorMiles);
    }
}