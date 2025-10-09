<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{-- Paciente: {{$paciente->nombres}} {{$paciente->apellidos}} --}}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #2c3e50;
            background: white;
        }

        @page {
            margin: 2cm 1.5cm 1.5cm 1.5cm;
            background: white;
        }

        #header {
            position: fixed;
            top: -1cm;
            left: 1.5cm;
            right: 1.5cm;
            height: 2cm;
            display: flex;
            align-items: center;
            background: white;
            /* border-bottom: 3px solid #000000; */
        }

        .imgHeader {
            position: fixed;
            top: 1.3cm;
            left: 1cm;
            width: 4cm;
            height: auto;
            margin-right: -0.5cm;
            margin-top: -2cm;
        }

        .imgTable {
            position: fixed;
            top: 1.1cm;
            left: 13cm;
            width: 2cm;
            height: auto;
            margin-left: 0.5cm;
            margin-top: -2cm;
        }

        .infoHeader {
            flex: 1;
            text-align: center;
            padding: 0 0.5cm;
        }

        .text-center {
            text-align: center;
            bottom: -1cm;
            top: -1cm;
            /*  background-color: green; */
        }

        .titulo {
            color: black;
            vertical-align: text-top;
            display: inline;
            font-size: 22px;
        }

        .titulo-fuente {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #000000;
            border-bottom: 2px solid #000000;
            padding-bottom: 0.2cm;
            margin-bottom: 0.6cm !important;
            margin-top: 0.3cm !important;
        }

        .encabezado-fuente {
            font-size: 10px;
            color: #000000;
            font-weight: bold;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        .font-16 {
            font-size: 13px;
            line-height: 1.6;
            color: #2c3e50;
        }

        .font-12 {
            font-size: 10px;
        }

        .nota-bancaria {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 6px;
            padding: 0.4cm;
            margin: 0.8cm 0;
            text-align: center;
            font-weight: bold;
            color: #856404;
        }

        .fecha-expedicion {
            font-style: italic;
            color: #000000;
            border-left: 4px solid #000000;
            padding-left: 0.5cm;
            margin: 1cm 0;
        }

        .text-justify {
            text-align: justify;
            line-height: 1.8;
            word-spacing: 0.1em;
        }

        .firma-section {
            margin-top: 2cm;
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

        .qr-container {
            margin-top: -5cm;
            margin-left: 0.5cm;
            display: flex;
            align-items: center;
        }

        .director-name {
            font-size: 11px;
            color: #000000;
            font-weight: bold;
            border-bottom: 1px solid #000000;
            padding-bottom: 0.1cm;
            margin-bottom: 0.3cm;
            display: inline-block;
        }

        .constancia-content {
            margin-top: 0.8cm;
            margin-left: 0cm;
            margin-right: 0cm;
            /* background: white; */
            padding: 0.8cm;
           /*  border: 1px solid #e8e8e8; */
            position: relative;
            /* border-radius: 10px; */
        }

        .logo {}

        #footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0cm;
            width: 100%;
            background-color: red;
            text-align: center;
        }

        .pie-pagina-bioanalista {
            position: fixed;
            width: 100%;
            text-align: center;
        }

        .hijo {
            width: 2cm;
            height: 1cm;
            margin: 0.2cm;
            background-color: yellow;
        }

        .table-border {
            border: 1px solid;
            width: 100%;
            left: 0.25cm;
            border-collapse: collapse;
        }

        .table-column-1 {
            border: 1px solid;
            width: 15%;
            left: 0.25cm;
            border-collapse: collapse;
        }

        #table-2 {
            position: fixed;
            top: -0.5cm;
            left: 3.1cm;
        }

        .table-column-2 {
            border: 1px solid;
            width: 16.6cm;
            left: 0.0cm;
            border-collapse: collapse;
        }

        .table-column-3 {
            /* border: 1px solid; */
            width: 8.6cm;
            left: 0.0cm;
            border-collapse: collapse;
        }

        .table-column-4 {
            /* border: 1px solid; */
            width: 8cm;
            left: 0.0cm;
            border-collapse: collapse;
        }

        #table-3 th,
        #table-3 td,
        {
        /* border: 1px solid #000; */
        padding-top: 5px;
        /* Aumenta el espaciado interno */
        padding-bottom: 5px;
        padding-left: 5px;
        /* text-align: center; */
        }

        #table-3 th {
            background-color: #f2f2f2;
        }

        #table-4 th,
        #table-4 td,
        {
        /* border: 1px solid #000; */
        padding-top: 5px;
        /* Aumenta el espaciado interno */
        padding-bottom: 5px;
        padding-left: 5px;
        /* text-align: center; */
        }

        #table-4 th {
            background-color: #f2f2f2;
        }

        #table-5 th,
        #table-5 td,
        {
        /* border: 1px solid #000; */
        padding-top: 5px;
        /* Aumenta el espaciado interno */
        padding-bottom: 5px;
        padding-left: 5px;
        /* text-align: center; */
        }

        #table-5 th {
            background-color: #f2f2f2;
        }

        #table-6 th,
        #table-6 td,
        {
        /* border: 1px solid #000; */
        padding-top: 5px;
        /* Aumenta el espaciado interno */
        padding-bottom: 5px;
        padding-left: 5px;
        /* text-align: center; */
        }

        #table-6 th {
            background-color: #f2f2f2;
        }



        #table-3 {
            position: fixed;
            top: 0.95cm;
            left: 3.1cm;
        }

        #table-4 {
            position: fixed;
            top: 0.95cm;
            left: 11.7cm;
        }

        .table-column-5 {
            /* border: 1px solid; */
            width: 8.6cm;
            left: 0.0cm;
            border-collapse: collapse;
        }

        #table-5 {
            position: absolute;
            /* top: 21.74cm; */
            margin-top: -0.68cm;
            left: 3.1cm;
        }

        .table-column-6 {
            /* border: 1px solid; */
            width: 8cm;
            left: 0.0cm;
            border-collapse: collapse;
        }

        #table-6 {
            position: absolute;
            margin-top: -0.68cm;
            left: 11.7cm;
        }

        .qr-code {
            width: 2.2cm;
            height: 2.2cm;
            border: 1.3px solid #000000;
            padding: 0.1cm;
            border-radius: 10px;
        }

        hr {
            border: 0.5px solid black;
            border-radius: 5px;
            top: -0.25cm;
        }

        .border {
            border: 0.5px solid black;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        br {
            display: block;
            /* makes it have a width */
            content: "";
            /* clears default height */
            margin-top: 0.04cm;
            /* change this to whatever height you want it */
        }
    </style>
</head>

<body>

    @php
        use App\Models\Setting;
        $meses = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE'
        ];
        $mes = $meses[$fecha->format('n')]; // Obtiene el número del mes y lo traduce
        $mesrecibo = $meses[$trabajador->primeraQuincena[0]->mes];
    @endphp

    <div id="header">
        <img class="imgHeader" src="{{public_path('storage/img/gobierno_bolivariano.png')}}">
        <div class="infoHeader">
            <p class="encabezado-fuente"><strong>REPÚBLICA BOLIVARIANA DE VENEZUELA</strong></p>
            <p class="encabezado-fuente"><strong>MINISTERIO DEL PODER POPULAR PARA LA SALUD</strong></p>
            <p class="encabezado-fuente"><strong>FUNDACIÓN TRUJILLANA DE LA SALUD</strong></p>
            <p class="encabezado-fuente"><strong>DIRECCIÓN ESTADAL DE RECURSOS HUMANOS</strong></p>
            <p class="encabezado-fuente"><strong>TRUJILLO ESTADO TRUJILLO</strong></p>
        </div>
        <img class="imgTable" src="{{public_path('storage/img/fundasalud.png')}}">
    </div>

    <div class="constancia-content">
        <h2 class="text-center titulo-fuente">CONSTANCIA</h2>
        
        <div class="text-justify font-16" style="margin-bottom: 0.8cm;">
            <p style="margin-bottom: 0.5cm; line-height: 1.8;">
                Quien suscribe, <strong style="color: #000000;">
                @if($ubicacion_fisica == 'FUNDASALUD (SEDE)')
                    DIRECTOR (E) ESTADAL DE TALENTO HUMANO DE LA FUNDACION TRUJILLANA DE LA SALUD DEL ESTADO TRUJILLO
                @else
                    COORDINADOR (A) DE TALENTO HUMANO DE {{ $ubicacion_fisica }}
                @endif
                </strong>, hace constar que el ciudadano: <strong style="color: #000000;">{{$trabajador->nombre}}</strong>, 
                titular de la <strong>C.I. {{ $trabajador->cedula }}</strong>, presta sus servicios en este organismo desde el <strong>{{$trabajador->fecha_ingreso}}</strong>
                hasta la presente fecha desempeñándose como: <strong style="color: #000000;">{{$trabajador->cargo}}</strong> en la <strong>FUNDACION TRUJILLANA DE LA SALUD</strong>
                estado Trujillo. Con financiamiento por el Presupuesto del Ministerio del Poder Popular para la Salud dicho trabajador(a) tiene una carga horaria de <strong>{{ $cantidad_horas }} horas</strong>
                en turno <strong>{{ $turno }}</strong>. Devengando un sueldo mensual de <strong style="color: #000000;">{{ numero_a_letras($trabajador->segundaQuincena[0]->total_asignaciones + $trabajador->primeraQuincena[0]->total_asignaciones)}} (BS. {{ formatear_moneda($trabajador->segundaQuincena[0]->total_asignaciones + $trabajador->primeraQuincena[0]->total_asignaciones)}})</strong>.
            </p>
        </div>

        <p class="font-16" style="margin-bottom: 0.5cm; text-align: center; font-weight: bold; background: #fff3cd; padding: 0.2cm; border: 1px solid #ffc107;"><strong>NOTA: {{ $nota }}</strong></p>
        
        <p class="font-16" style="margin-bottom: 0.8cm; line-height: 1.6; font-style: italic;">
            Constancia que se expide en la ciudad de Trujillo, a los <strong>{{$fecha->format('d')}}</strong> días del mes de <strong>{{$mes}}</strong> de <strong>{{$fecha->format('Y')}}</strong>. Válida por <strong>un (1) mes</strong>.
        </p>

        <!-- Sección de firma con QR code -->
        <div class="firma-section">
            <div class="firma-info">
                <div class="director-name">{{ $jefe_inmediato->nombre }}</div>
                <p style="margin-bottom: 0.2cm; font-weight: bold; color: #000000;">
                    @if($ubicacion_fisica == 'FUNDASALUD (SEDE)')
                        DIRECTOR (E) ESTADAL DE TALENTO HUMANO DE LA FUNDACION TRUJILLANA DE LA SALUD DEL ESTADO TRUJILLO
                    @else
                        COORDINADOR (A) DE TALENTO HUMANO DE {{ $ubicacion_fisica }}
                    @endif
                </p>
                <p style="margin-bottom: 0.2cm; color: #495057;">{{ $ubicacion_fisica }}</p>
                <br>
                <br>

                {{-- <p style="margin-bottom: 0.2cm; color: #495057;">RESOLUCIÓN {{Setting::get('resolucion_director_talento_humano')}}</p>
                <p style="margin-bottom: 0.4cm; color: #495057;">SUSCRITA POR LA MINISTRA DEL PODER POPULAR PARA LA SALUD</p> --}}
                
                <div style="border-top: 1px solid #dee2e6; padding-top: 0.3cm; margin-top: 0.3cm;">
                    {{-- <p style="margin-bottom: 0.1cm; font-size: 7px; text-align: left; color: #6c757d;">RC/ac</p> --}}
                    <div style="font-size: 8px; line-height: 1.2; color: #6c757d;">
                        <p style="margin-bottom: 0.05cm;">{{Setting::get('direccion_fiscal')}} RIF {{Setting::get('rif')}}</p>
                        <p>Correo electrónico: {{Setting::get('email')}}</p>
                    </div>
                </div>
            </div>
            
            <div class="qr-container">
                <img class="qr-code" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($ruta)) !!} ">
            </div>
        </div>
    </div>



</body>

</html>