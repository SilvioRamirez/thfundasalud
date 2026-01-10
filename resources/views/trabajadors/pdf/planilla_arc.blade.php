<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planilla ARC - {{ $trabajador->cedula }} - {{ $ano }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        @page {
            margin: 3cm 1cm 1.5cm 1cm;
        }

        #header {
            position: fixed;
            top: -2.5cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;
        }

        .header-container {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .header-left,
        .header-center,
        .header-right {
            display: table-cell;
            vertical-align: middle;
        }

        .header-left {
            width: 15%;
            text-align: center;
            padding-left: 0.5cm;
        }

        .header-center {
            width: 70%;
            text-align: center;
            padding: 0 0.2cm;
        }

        .header-right {
            width: 15%;
            text-align: center;
            padding-right: 0.5cm;
        }

        .imgHeader-left {
            max-width: 2cm;
            max-height: 2cm;
            width: auto;
            height: auto;
        }

        .imgHeader-right {
            max-width: 2.5cm;
            max-height: 2cm;
            width: auto;
            height: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .titulo-principal {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .encabezado-fuente {
            font-size: 11px;
            line-height: 1.3;
        }

        .table-border {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        .table-border th,
        .table-border td {
            border: 1px solid black;
            padding: 5px;
        }

        .bg-gray {
            background-color: #C0C0C0;
        }

        .bg-light-gray {
            background-color: #E8E8E8;
        }

        .info-trabajador {
            width: 100%;
            margin-bottom: 15px;
        }

        .info-trabajador td {
            padding: 3px;
        }

        .deducciones-ley {
            width: 100%;
            margin: 15px 0;
        }

        .tabla-meses {
            width: 50%;
            margin-top: 15px;
            margin-left: 25%;
        }

        .tabla-meses th {
            background-color: #C0C0C0;
            font-weight: bold;
        }

        .total-row {
            background-color: #C0C0C0;
            font-weight: bold;
        }

        .footer-info {
            position: fixed;
            bottom: 1cm;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 11px;
        }

        .qr-code {
            position: fixed;
            bottom: 5.5cm;
            right: 2cm;
        }

        br {
            display: block;
            content: "";
            margin-top: 0.04cm;
        }

        .firma-section {
            margin-top: 1cm;
            padding: 0.6cm;
            /* border: 1px solid #000000; */
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-radius: 10px;
        }

        .firma-info {
            flex: 1;
            text-align: center;
            font-size: 9px;
            line-height: 1.2;
        }

    </style>
</head>
<body>

    @php
        use App\Models\Setting;
        $meses = [
            1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL',
            5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO',
            9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
        ];
        $mesActual = $meses[$fecha->format('n')];
    @endphp

    <!-- Header -->
    <div id="header">
        <div class="header-container">
            <div class="header-left">
                <img class="imgHeader-left" src="{{ public_path('storage/img/minsalud.jpg') }}" alt="Ministerio de Salud">
            </div>
            <div class="header-center">
                <div class="encabezado-fuente"><strong>REPÚBLICA BOLIVARIANA DE VENEZUELA</strong></div>
                <div class="encabezado-fuente"><strong>MINISTERIO DEL PODER POPULAR PARA LA SALUD</strong></div>
                <div class="encabezado-fuente"><strong>GOBIERNO BOLIVARIANO DE TRUJILLO</strong></div>
                <div class="encabezado-fuente"><strong>FUNDACIÓN TRUJILLANA DE LA SALUD</strong></div>
            </div>
            <div class="header-right">
                <img class="imgHeader-right" src="{{ public_path('storage/img/fundasalud.png') }}" alt="Fundasalud">
            </div>
        </div>
    </div>

    <!-- Título -->
    <div class="titulo-principal">
        PLANILLA ARC
    </div>

    <!-- Información del Trabajador -->
    <table class="info-trabajador table-border">
        <tr>
            <td style="width: 20%;"><strong>CÉDULA:</strong></td>
            <td style="width: 30%;">{{ $trabajador->cedula }}</td>
            <td style="width: 20%;"><strong>CÓDIGO:</strong></td>
            <td style="width: 30%;">{{ $trabajador->codigo_rac ?? '***' }}</td>
        </tr>
        <tr>
            <td><strong>NOMBRES:</strong></td>
            <td colspan="3">{{ $trabajador->nombre }}</td>
        </tr>
        <tr>
            <td><strong>CARGO:</strong></td>
            <td colspan="3">{{ $trabajador->cargo }}</td>
        </tr>
        <tr>
            <td><strong>AÑO:</strong></td>
            <td>{{ $ano }}</td>
            <td><strong>INGRESO:</strong></td>
            <td>{{ $trabajador->fecha_ingreso }}</td>
        </tr>
    </table>

    <!-- Deducciones de Ley -->
    <div class="text-center" style="margin: 15px 0;">
        <strong style="font-size: 14px;">DEDUCCIONES DE LEY</strong>
    </div>

    <table class="deducciones-ley table-border">
        <tr class="bg-light-gray">
            <td style="width: 30%;"><strong>S.S.O.:</strong></td>
            <td class="text-right" style="width: 20%;">{{ formatear_moneda($deduccionesLey['sso']) }}</td>
            <td style="width: 30%;"><strong>PARO FORZOSO:</strong></td>
            <td class="text-right" style="width: 20%;">{{ formatear_moneda($deduccionesLey['paro_forzoso']) }}</td>
        </tr>
        <tr>
            <td><strong>FONDO JUBILACIÓN:</strong></td>
            <td class="text-right">{{ formatear_moneda($deduccionesLey['fondo_jubilacion']) }}</td>
            <td><strong>FONDO VIVIENDA Y HÁBITAT:</strong></td>
            <td class="text-right">{{ formatear_moneda($deduccionesLey['faov']) }}</td>
        </tr>
        <tr class="bg-light-gray">
            <td><strong>IMPUESTO SOBRE LA RENTA:</strong></td>
            <td class="text-right">{{ formatear_moneda($deduccionesLey['impuesto_renta']) }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- Tabla de Meses -->
    <table class="tabla-meses table-border">
        <thead>
            <tr>
                <th style="width: 50%;">MES</th>
                <th style="width: 50%;">MONTO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meses as $numMes => $nombreMes)
                <tr>
                    <td class="text-center">{{ $nombreMes }}</td>
                    <td class="text-center">{{ formatear_moneda($datosMensuales[$numMes]) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td class="text-center"><strong>TOTAL ANUAL</strong></td>
                <td class="text-center"><strong>{{ formatear_moneda($totalAnualAsignaciones) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer-info">
        <p><strong>Información:</strong> Este Recibo <strong>NO ES VÁLIDO</strong> para realizar trámites legales sin el sello y la firma de la Dirección de Recursos Humanos de</p>
        <p><strong>FUNDACIÓN TRUJILLANA DE LA SALUD</strong></p>
        <p style="margin-top: 10px;">
            <strong>AGENTE DE RETENCIÓN</strong><br>
            Correo: {{ $ubicacion_fisica->correo }}
        </p>
        <p style="margin-top: 5px;">
            <strong>FECHA Y HORA DE IMPRESIÓN:</strong> {{ $fecha->format('d') }} de {{ $mesActual }} de {{ $fecha->format('Y') }} - {{ $fecha->format('H:i') }}
        </p>
    </div>

    <!-- QR Code -->
    <div class="qr-code">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($ruta)) !!}">
    </div>

    <!-- Sección de firma -->
    <div class="firma-section">
        <div class="firma-info">
            <div class="director-name" style="font-weight: bold; color: #000000; font-size: 11px;">{{ Setting::get('director_talento_humano') }}</div>
            <p style="margin-bottom: 0.2cm; font-weight: bold; color: #000000;">
                    DIRECTOR ESTADAL DE TALENTO HUMANO <br> FUNDACION TRUJILLANA DE LA SALUD DEL ESTADO TRUJILLO <br>
                    DESIGNACIÓN {{Setting::get('designacion_director_talento_humano')}} <br>
                    RESOLUCIÓN {{Setting::get('resolucion_director_talento_humano')}} <br>
                    SUSCRITA POR LA MINISTRA DEL PODER POPULAR PARA LA SALUD
            </p>
        </div>
    </div>

</body>
</html>
