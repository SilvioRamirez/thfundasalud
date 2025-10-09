<?php

if (!function_exists('formatear_moneda')) {
    function formatear_moneda($numero, $decimales = 2, $separadorDecimal = ',', $separadorMiles = '.')
    {
        return number_format($numero, $decimales, $separadorDecimal, $separadorMiles);
    }
}

if (!function_exists('numero_a_letras')) {

    function numero_a_letras($valor, $moneda = 'bolívares digitales', $centimos = 'céntimos')
    {
        // limpieza: quitar paréntesis, "BS.", espacios, etc.
        $s = trim($valor);
        $s = str_ireplace(['(', ')', 'BS.', 'Bs.', 'bs.', 'BS', 'Bs', 'bs', '$'], '', $s);
        $s = str_replace(' ', '', $s);

        // Normalizar separador decimal: aceptar coma o punto.
        $s = str_replace(',', '.', $s);
        if (!is_numeric($s)) {
            return ''; // o lanzar excepción si prefieres
        }

        $number = number_format((float)$s, 2, '.', ''); // asegura dos decimales
        list($enteros, $decimales) = explode('.', $number);

        $enteros = (int)$enteros;
        $decimales = (int)$decimales;

        if ($enteros === 0) {
            $parteEntera = 'cero';
        } else {
            $parteEntera = _convertir_en_letras($enteros);
        }

        // 👉 Aquí agregas el snippet para singular/plural
        $moneda = $enteros === 1 ? 'bolívar digital' : 'bolívares digitales';

        // manejo plural de la moneda (si pones "bolívar" podrías querer singular/plural)
        // asumimos que $moneda ya está en forma adecuada (ej "bolívares digitales")
        $resultado = mb_strtoupper($parteEntera . ' ' . $moneda . ' con ' . _convertir_en_letras($decimales) . ' ' . $centimos, 'UTF-8');

        return $resultado;
    }
}

if (!function_exists('_convertir_en_letras')) {
    function _convertir_en_letras($num)
    {
        $UNIDADES = [
            "",
            "uno",
            "dos",
            "tres",
            "cuatro",
            "cinco",
            "seis",
            "siete",
            "ocho",
            "nueve",
            "diez",
            "once",
            "doce",
            "trece",
            "catorce",
            "quince",
            "diecinueve",
            "veinte"
        ];
        $DECENAS = ["", "", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa"];
        $CENTENAS = ["", "ciento", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos"];

        if ($num < 21) {
            return $UNIDADES[$num];
        }
        if ($num < 100) {
            $d = (int)($num / 10);
            $r = $num % 10;
            if ($num <= 29) { // 21..29: veintiuno, veintidós...
                if ($num == 21) return "veintiuno";
                if ($num == 22) return "veintidós";
                if ($num == 23) return "veintitrés";
                if ($num == 26) return "veintiséis";
                return "veinti" . $UNIDADES[$r];
            }
            $textoDecena = $DECENAS[$d];
            if ($r > 0) return $textoDecena . " y " . $UNIDADES[$r];
            return $textoDecena;
        }
        if ($num < 1000) {
            if ($num == 100) return "cien";
            $c = (int)($num / 100);
            $resto = $num % 100;
            $texto = $CENTENAS[$c];
            if ($resto > 0) $texto .= " " . _convertir_en_letras($resto);
            return $texto;
        }

        // miles
        if ($num < 1000000) {
            $m = (int)($num / 1000);
            $resto = $num % 1000;
            $texto = ($m == 1) ? "mil" : _convertir_en_letras($m) . " mil";
            if ($resto > 0) $texto .= " " . _convertir_en_letras($resto);
            return $texto;
        }

        // millones
        if ($num < 1000000000000) {
            $m = (int)($num / 1000000);
            $resto = $num % 1000000;
            $texto = ($m == 1) ? "un millón" : _convertir_en_letras($m) . " millones";
            if ($resto > 0) $texto .= " " . _convertir_en_letras($resto);
            return $texto;
        }

        // arriba de billón (manejo simple)
        $b = (int)($num / 1000000000000);
        $resto = $num % 1000000000000;
        $texto = _convertir_en_letras($b) . " billones";
        if ($resto > 0) $texto .= " " . _convertir_en_letras($resto);
        return $texto;
    }
}
