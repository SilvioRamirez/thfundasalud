<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{-- Paciente: {{$paciente->nombres}} {{$paciente->apellidos}} --}}</title>
    <style>

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        @page{
            margin: 3cm 0.5cm 1.5cm 0.5cm;
        }

        #header{
            position: fixed;
            top: -2.6cm;
            left: 0.5cm;
        }
        
        .imgHeader{
            float: left;
            width: 6cm;
            margin-top: 0.3cm;
        }

        .imgTable{
            float: none;
            width: 2.6cm;
            height: 1.58cm;
            margin-top: 0.1cm;
            margin-bottom: 0.1cm;
            margin-right: -0.5cm;
            margin-left: -0.5cm;
        }

        .imgTable-2{
            float: none;
            width: 3cm;
            height: 1cm;
            margin-top: 0.1cm;
            margin-bottom: 0.1cm;
            margin-right: -0.0cm;
            margin-left: -0.0cm;
        }

        .infoHeader{
            float: left;
            margin-left: 0.2cm;
            margin-right: 0.2cm;
        }

        .text-center{
            text-align: center;
            bottom: -1cm;
            top: -1cm;
           /*  background-color: green; */
        }

        .titulo{
            color: black;
            vertical-align: text-top;
            display: inline;
            font-size: 22px;
        }

        .titulo-fuente{
            font-size: 26px;
        }

        .encabezado-fuente{
            font-size: 10px;
            
        }

        .font-16{
            font-size: 12px;
            
        }

        .logo{
            
        }

        #footer{
            position: fixed;
            bottom: -1.5cm;
            left: 0cm;
            width: 100%;
            background-color: red;
            text-align: center;
        }

        .pie-pagina-bioanalista{
            position: fixed;
            width: 100%;
            text-align: center;
        }

        .hijo{
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

        #table-2{
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

        #table-3 th, #table-3 td, {
            /* border: 1px solid #000; */
            padding-top: 5px; /* Aumenta el espaciado interno */
            padding-bottom: 5px;
            padding-left: 5px;
            /* text-align: center; */
        }
        #table-3 th {
            background-color: #f2f2f2;
        }

        #table-4 th, #table-4 td, {
            /* border: 1px solid #000; */
            padding-top: 5px; /* Aumenta el espaciado interno */
            padding-bottom: 5px;
            padding-left: 5px;
            /* text-align: center; */
        }
        #table-4 th {
            background-color: #f2f2f2;
        }

        #table-5 th, #table-5 td, {
            /* border: 1px solid #000; */
            padding-top: 5px; /* Aumenta el espaciado interno */
            padding-bottom: 5px;
            padding-left: 5px;
            /* text-align: center; */
        }
        #table-5 th {
            background-color: #f2f2f2;
        }

        #table-6 th, #table-6 td, {
            /* border: 1px solid #000; */
            padding-top: 5px; /* Aumenta el espaciado interno */
            padding-bottom: 5px;
            padding-left: 5px;
            /* text-align: center; */
        }
        #table-6 th {
            background-color: #f2f2f2;
        }

        

        #table-3{
            position: fixed;
            top: 0.95cm;
            left: 3.1cm;
        }

        #table-4{
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
        #table-5{
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
        #table-6{
            position: absolute;
            margin-top: -0.68cm;
            left: 11.7cm; 
        }

        #img-qrcode{
            position: absolute;
            left: 0.25cm;
            margin-top: 0.5cm;
            /* top: 22.6cm; */
            /* border: 0.5px solid red; */
        }

        hr{
            border: 0.5px solid black;
            border-radius: 5px;
            top: -0.25cm;
        }

        .border{
            border: 0.5px solid black;
        }

        .border-collapse{
            border-collapse: collapse;
        }

        br {
            display: block; /* makes it have a width */
            content: ""; /* clears default height */
            margin-top: 0.04cm; /* change this to whatever height you want it */
        }
    </style>
</head>
<body>

@php
    $meses = [
        1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL',
        5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO',
        9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
    ];
    $mes = $meses[$fecha->format('n')]; // Obtiene el número del mes y lo traduce
    $mesrecibo = $meses[$trabajador->primeraQuincena[0]->mes];
@endphp

    <div id="header">
        <img class="imgHeader" src="{{public_path('storage/img/ministerio_salud.png')}}">
        <div class="infoHeader">            
            <table class="border-collapse">
                <tbody>
                    <tr>
                        <td class="text-center encabezado-fuente"><strong>REPUBLICA BOLIVARIANA DE VENEZUELA</strong></td>
                    </tr>
                    <tr>
                        <td class="text-center encabezado-fuente"><strong>MINISTERIO DEL PODER POPULAR PARA LA SALUD</strong></td>
                    </tr>
                    <tr>
                        <td class="text-center encabezado-fuente"><strong>GOBIERNO BOLIVARIANO DE TRUJILLO</strong></td>
                    </tr>
                    <tr>
                        <td class="text-center encabezado-fuente"><strong>FUNDACION TRUJILLANA DE LA SALUD</strong></td>
                    </tr>
                    <tr>
                        <td class="text-center encabezado-fuente"><strong>DIRECCION ESTADAL DE RECURSOS HUMANOS</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <img class="imgHeader" src="{{public_path('storage/img/gobierno_bolivariano.png')}}">
    </div>

    <div class="encabezado-fuente" style="margin-top: -0.5cm;">
        <table class="table-column-1">
            <thead>
            <tr>
                <th class="border" rowspan="1"><img class="imgTable" src="{{public_path('storage/img/fundasalud.png')}}"></th>
                {{-- <th class="border" rowspan="2">Cédula</th>
                <th class="border" colspan="2">Primera Quincena</th>
                <th class="border" colspan="2">Segunda Quincena</th> --}}
            </tr>
            {{-- <tr>
                <th class="border" >Días Trabajados</th>
                <th class="border" >Salario</th>
                <th class="border" >Días Trabajados</th>
                <th class="border" >Salario</th>
            </tr> --}}
            </thead>
            <tbody>
                <tr>
                    <td class="text-center border">He recibido de la entidad pagadora la cantidad indicada en este Recibo por el Pago Correspondiente al</td>
                    {{-- <td class="">{{$trabajador->cedula}}</td> --}}
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Mes:</strong> <br> {{$mesrecibo}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Año:</strong> <br> {{ $trabajador->primeraQuincena[0]->ano}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Personal:</strong> <br> {{$trabajador->nomina}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Banco:</strong> <br> {{'VENEZUELA'}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Cuenta:</strong> <br> {{$trabajador->cuenta}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Fecha de Ingreso Funda:</strong> <br> {{$trabajador->fecha_ingreso}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Tiempo de Servicio APN:</strong> <br> {{$trabajador->anos_apn}} AÑOS&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>Dependencia:</strong> <br> {{$trabajador->dependencia}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border" style="background-color: #C0C0C0;"><strong><br>PRIMERA QUINCENA</strong> <br></td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>TOTAL ASIGNACIONES</strong> <br> {{ formatear_moneda($trabajador->primeraQuincena[0]->total_asignaciones)}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>TOTAL DEDUCCIONES</strong> <br> {{ formatear_moneda($trabajador->primeraQuincena[0]->total_deduciones)}}&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center border" style="background-color: #C0C0C0;"><strong><br>TOTAL PAGADO</strong><br>{{ formatear_moneda($trabajador->primeraQuincena[0]->total)}}&nbsp;</td>
                </tr>
                <tr>
                    <td class=""><img class="imgTable-2" src="{{public_path('storage/img/batalla_carabobo.png')}}"></td>
                </tr>
                <tr>
                    <td class="text-center border" style="background-color: #C0C0C0;"><strong><br>SEGUNDA QUINCENA</strong> <br></td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>TOTAL ASIGNACIONES</strong> <br> {{ formatear_moneda($trabajador->segundaQuincena[0]->total_asignaciones) }}</td>
                </tr>
                <tr>
                    <td class="text-center border"><strong><br>TOTAL DEDUCCIONES</strong> <br> {{ formatear_moneda($trabajador->segundaQuincena[0]->total_deduciones) }}</td>
                </tr>
                <tr>
                    <td class="text-center border" style="background-color: #C0C0C0;"><strong><br>TOTAL PAGADO</strong><br>{{ formatear_moneda($trabajador->segundaQuincena[0]->total) }}</td>
                </tr>
                <tr>
                    <td class="text-center border" style="font-size: 8px;">Información: Este Recibo NO ES VÁLIDO para realizar trámites legales sin el sello y la firma de la Dirección de Talento Humano de la FUNDACION TRUJILLANA DE LA SALUD</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="encabezado-fuente" id="table-2">
        <table class="table-column-2">
            <tbody>
                <tr>
                    <td class=""><strong>Cédula:</strong> &nbsp; <div class="text-center">{{$trabajador->cedula}}</div></td>
                    <td class=""><strong>Nombre:</strong> &nbsp; <div class="text-center">{{$trabajador->nombre}}</div></td>
                </tr>
                <tr>
                    <td class=""><strong>Cargo:</strong> &nbsp; <div class="text-center">{{$trabajador->cargo}}</div></td>
                    <td class=""><strong>Código RAC:</strong> &nbsp; <div class="text-center">{{$trabajador->codigo_rac}}</div></td>
                </tr>
                {{-- <tr>
                    <td class="border text-center" style="background-color: #C0C0C0;"><strong>Asignaciones:</strong></td>
                    <td class="border text-center" style="background-color: #C0C0C0;"><strong>Deducciones:</strong></td>
                </tr>
                <tr>
                    <td class="" style="background-color: #EAEAEA; font-style: italic;"><strong>&nbsp;&nbsp;PRIMERA QUINCENA:</strong></td>
                    <td class="" style="background-color: #EAEAEA;"></td>
                </tr> --}}
                
            </tbody>
        </table>
    </div>

    <div class="encabezado-fuente" id="table-3">
        <table class="table-column-3">
            <tbody>
                <tr>
                    <td class="border text-center" colspan="2" style="background-color: #C0C0C0;"><strong>Asignaciones:</strong></td>
                </tr>

                {{-- PRIMERA QUINCENA --}}

                <tr>
                    <td class="" colspan="2" style="background-color: #EAEAEA; font-style: italic;"><strong>&nbsp;&nbsp;PRIMERA QUINCENA:</strong></td>
                </tr>
                @if ($trabajador->primeraQuincena[0]->sueldo_base_quincenal != 0)
                    <tr>
                        <td class=""><strong>SUELDO BASE (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sueldo_base_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->diferencia_de_sueldo_por_funcion_quincenal != 0)
                    <tr>
                        <td class=""><strong>DIFERENCIA DE SUELDO POR FUNCION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->diferencia_de_sueldo_por_funcion_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->compensacion_por_evaluacion_quincenal != 0)
                    <tr>
                        <td class=""><strong>COMPENSACION POR EVALUACION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->compensacion_por_evaluacion_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre != 0)
                    <tr>
                        <td class=""><strong>EVALUACION POR COMPENSACION 2DO SEMESTRE 2024 (JULIO-DICIEMBRE):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->escalafon_medico_quincenal != 0)
                    <tr>
                        <td class=""><strong>ESCALAFON MEDICO (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->escalafon_medico_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->escalafon_asistencial_quincenal != 0)
                    <tr>
                        <td class=""><strong>ESCALAFON ASISTENCIAL (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->escalafon_asistencial_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->prima_daspuns_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA DASPUNS (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->prima_daspuns_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->prima_por_antiguedad_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA POR ANTIGUEDAD (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->prima_por_antiguedad_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->prima_por_profesionalizacion_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA POR PROFESIONALIZACION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->prima_por_profesionalizacion_quincenal)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->dia_adicional != 0)
                    <tr>
                        <td class=""><strong>DIA ADICIONAL:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->dia_adicional)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->jerarquia_o_responsabilidad_empleado != 0)
                    <tr>
                        <td class=""><strong>JERARQUIA O RESPONSABILIDAD (EMPLEADO):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->jerarquia_o_responsabilidad_empleado)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->bono_del_dia_del_nino != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DEL NINO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->bono_del_dia_del_nino)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->bono_del_dia_del_padre != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DEL PADRE:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->bono_del_dia_del_padre)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->bono_del_dia_de_la_madre != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DE LA MADRE:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->bono_del_dia_de_la_madre)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->bono_de_uniformes != 0)
                    <tr>
                        <td class=""><strong>BONO DE UNIFORMES:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->bono_de_uniformes)}}</td>
                    </tr>
                @endif

                {{-- Segunda Quincena --}}

                <tr>
                    <td class="" colspan="2" style="background-color: #EAEAEA; font-style: italic;"><strong>&nbsp;&nbsp;SEGUNDA QUINCENA:</strong></td>
                </tr>

                @if ($trabajador->segundaQuincena[0]->sueldo_base_quincenal != 0)
                    <tr>
                        <td class=""><strong>SUELDO BASE (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sueldo_base_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->diferencia_de_sueldo_por_funcion_quincenal != 0)
                    <tr>
                        <td class=""><strong>DIFERENCIA DE SUELDO POR FUNCION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->diferencia_de_sueldo_por_funcion_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->compensacion_por_evaluacion_quincenal != 0)
                    <tr>
                        <td class=""><strong>COMPENSACION POR EVALUACION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->compensacion_por_evaluacion_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre != 0)
                    <tr>
                        <td class=""><strong>EVALUACION POR COMPENSACION 2DO SEMESTRE 2024 (JULIO-DICIEMBRE):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->escalafon_medico_quincenal != 0)
                    <tr>
                        <td class=""><strong>ESCALAFON MEDICO (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->escalafon_medico_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->escalafon_asistencial_quincenal != 0)
                    <tr>
                        <td class=""><strong>ESCALAFON ASISTENCIAL (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->escalafon_asistencial_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->prima_daspuns_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA DASPUNS (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->prima_daspuns_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->prima_por_antiguedad_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA POR ANTIGUEDAD (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->prima_por_antiguedad_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->prima_por_profesionalizacion_quincenal != 0)
                    <tr>
                        <td class=""><strong>PRIMA POR PROFESIONALIZACION (QUINCENAL):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->prima_por_profesionalizacion_quincenal) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->dia_adicional != 0)
                    <tr>
                        <td class=""><strong>DIA ADICIONAL:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->dia_adicional) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_nocturno_por_guardia != 0)
                    <tr>
                        <td class=""><strong>BONO NOCTURNO POR GUARDIA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_nocturno_por_guardia) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_nocturno_fijo != 0)
                    <tr>
                        <td class=""><strong>BONO NOCTURNO FIJO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_nocturno_fijo) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->domingo_y_feriados_por_guardia != 0)
                    <tr>
                        <td class=""><strong>DOMINGO Y FERIADOS POR GUARDIA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->domingo_y_feriados_por_guardia) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_vacacional != 0)
                    <tr>
                        <td class=""><strong>BONO VACACIONAL:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_vacacional) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->prima_por_hijos != 0)
                    <tr>
                        <td class=""><strong>PRIMA POR HIJOS	:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->prima_por_hijos) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->jerarquia_o_responsabilidad_empleado != 0)
                    <tr>
                        <td class=""><strong>JERARQUIA O RESPONSABILIDAD (EMPLEADO):</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->jerarquia_o_responsabilidad_empleado) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_del_dia_del_nino != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DEL NINO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_del_dia_del_nino) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_del_dia_del_padre != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DEL PADRE:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_del_dia_del_padre) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_del_dia_de_la_madre != 0)
                    <tr>
                        <td class=""><strong>BONO DEL DIA DE LA MADRE:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_del_dia_de_la_madre) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->bono_de_uniformes != 0)
                    <tr>
                        <td class=""><strong>BONO DE UNIFORMES:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->bono_de_uniformes) }}</td>
                    </tr>
                @endif



            </tbody>
        </table>

        
    </div>

    {{-- Deducciones --}}
    <div class="encabezado-fuente" id="table-4">
        <table class="table-column-4">
            <tbody>
                <tr>
                    <td class="border text-center" colspan="2" style="background-color: #C0C0C0;"><strong>Deducciones:</strong></td>
                </tr>
                <tr>
                    <td class="" colspan="2" style="background-color: #EAEAEA; font-style: italic;"><strong>&nbsp;&nbsp;PRIMERA QUINCENA</strong></td>
                </tr>

                @if ($trabajador->primeraQuincena[0]->sso != 0)
                    <tr>
                        <td class=""><strong>SSO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sso)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->paro_forzoso != 0)
                    <tr>
                        <td class=""><strong>PARO FORZOSO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->paro_forzoso)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->faov != 0)
                    <tr>
                        <td class=""><strong>FAOV:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->faov)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->inces != 0)
                    <tr>
                        <td class=""><strong>INCES:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->inces)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->fondo_de_jubilacion != 0)
                    <tr>
                        <td class=""><strong>FONDO DE JUBILACION:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->fondo_de_jubilacion)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->catset != 0)
                    <tr>
                        <td class=""><strong>CATSET:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->catset)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->cahorminsas != 0)
                    <tr>
                        <td class=""><strong>CAHORMINSAS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->cahorminsas)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->asociacion_cooperativa_trujillo != 0)
                    <tr>
                        <td class=""><strong>ASOCIACION COOPERATIVA TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->asociacion_cooperativa_trujillo)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->asociacion_cooperativa_valera != 0)
                    <tr>
                        <td class=""><strong>ASOCIACION COOPERATIVA VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->asociacion_cooperativa_valera)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->pension_por_manutencion != 0)
                    <tr>
                        <td class=""><strong>PENSION POR MANUTENCION:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->pension_por_manutencion)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->sinboproenf != 0)
                    <tr>
                        <td class=""><strong>SINBOPROENF:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sinboproenf)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->surbsset != 0)
                    <tr>
                        <td class=""><strong>S.U.R.B.S.S.E.T.:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->surbsset)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->sunepsas != 0)
                    <tr>
                        <td class=""><strong>SUNEPSAS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sunepsas)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->impreenfermeras_valera != 0)
                    <tr>
                        <td class=""><strong>IMPREENFERMERAS VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->impreenfermeras_valera)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->impreenfermeras_trujillo != 0)
                    <tr>
                        <td class=""><strong>IMPREENFERMERAS TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->impreenfermeras_trujillo)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->colegio_de_enfermeria_trujillo != 0)
                    <tr>
                        <td class=""><strong>COLEGIO DE ENFERMERIA TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->colegio_de_enfermeria_trujillo)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->colegio_de_enfermeras_valera != 0)
                    <tr>
                        <td class=""><strong>COLEGIO DE ENFERMERAS VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->colegio_de_enfermeras_valera)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->sitrasalud_trujillo != 0)
                    <tr>
                        <td class=""><strong>SITRASALUD – TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sitrasalud_trujillo)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->surtrapps != 0)
                    <tr>
                        <td class=""><strong>SURTRAPPS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->surtrapps)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->fenasirtrasalud != 0)
                    <tr>
                        <td class=""><strong>FENASIRTRASALUD:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->fenasirtrasalud)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->sutset != 0)
                    <tr>
                        <td class=""><strong>SUTSET:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sutset)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->fetratrujillo != 0)
                    <tr>
                        <td class=""><strong>FETRATRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->fetratrujillo)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->fetrasalud != 0)
                    <tr>
                        <td class=""><strong>FETRASALUD:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->fetrasalud)}}</td>
                    </tr>
                @endif
                @if ($trabajador->primeraQuincena[0]->sindicato_de_salud != 0)
                    <tr>
                        <td class=""><strong>SINDICATO DE SALUD:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->primeraQuincena[0]->sindicato_de_salud)}}</td>
                    </tr>
                @endif

                {{-- Segunda Quincena --}}

                <tr>
                    <td class="" colspan="2" style="background-color: #EAEAEA; font-style: italic;"><strong>&nbsp;&nbsp;SEGUNDA QUINCENA:</strong></td>
                </tr>

                @if ($trabajador->segundaQuincena[0]->catset != 0)
                    <tr>
                        <td class=""><strong>CATSET:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->catset) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->cahorminsas != 0)
                    <tr>
                        <td class=""><strong>CAHORMINSAS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->cahorminsas) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->asociacion_cooperativa_trujillo != 0)
                    <tr>
                        <td class=""><strong>ASOCIACION COOPERATIVA TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->asociacion_cooperativa_trujillo) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->asociacion_cooperativa_valera != 0)
                    <tr>
                        <td class=""><strong>ASOCIACION COOPERATIVA VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->asociacion_cooperativa_valera) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->pension_por_manutencion != 0)
                    <tr>
                        <td class=""><strong>PENSION POR MANUTENCION:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->pension_por_manutencion) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->sinboproenf != 0)
                    <tr>
                        <td class=""><strong>SINBOPROENF:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sinboproenf) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->surbsset != 0)
                    <tr>
                        <td class=""><strong>S.U.R.B.S.S.E.T.:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->surbsset) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->sunepsas != 0)
                    <tr>
                        <td class=""><strong>SUNEPSAS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sunepsas) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->impreenfermeras_valera != 0)
                    <tr>
                        <td class=""><strong>IMPREENFERMERAS VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->impreenfermeras_valera) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->impreenfermeras_trujillo != 0)
                    <tr>
                        <td class=""><strong>IMPREENFERMERAS TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->impreenfermeras_trujillo) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->colegio_de_enfermeria_trujillo != 0)
                    <tr>
                        <td class=""><strong>COLEGIO DE ENFERMERIA TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->colegio_de_enfermeria_trujillo) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->colegio_de_enfermeras_valera != 0)
                    <tr>
                        <td class=""><strong>COLEGIO DE ENFERMERAS VALERA:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->colegio_de_enfermeras_valera) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->sitrasalud_trujillo != 0)
                    <tr>
                        <td class=""><strong>SITRASALUD – TRUJILLO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sitrasalud_trujillo) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->surtrapps != 0)
                    <tr>
                        <td class=""><strong>SURTRAPPS:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->surtrapps) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->fenasirtrasalud != 0)
                    <tr>
                        <td class=""><strong>FENASIRTRASALUD:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->fenasirtrasalud) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->sutset != 0)
                    <tr>
                        <td class=""><strong>SUTSET:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sutset) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->fetrasalud != 0)
                    <tr>
                        <td class=""><strong>FETRASALUD:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->fetrasalud) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->sso != 0)
                    <tr>
                        <td class=""><strong>SSO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->sso) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->paro_forzoso != 0)
                    <tr>
                        <td class=""><strong>PARO FORZOSO:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->paro_forzoso) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->faov != 0)
                    <tr>
                        <td class=""><strong>FAOV:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->faov) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->inces != 0)
                    <tr>
                        <td class=""><strong>INCES:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->inces) }}</td>
                    </tr>
                @endif
                @if ($trabajador->segundaQuincena[0]->fondo_de_jubilacion != 0)
                    <tr>
                        <td class=""><strong>FONDO DE JUBILACION:</strong></td>
                        <td class="" style="text-align: right;">{{ formatear_moneda($trabajador->segundaQuincena[0]->fondo_de_jubilacion) }}</td>
                    </tr>
                @endif
                
            </tbody>
        </table>
    </div>

    {{-- TOTAL ASIGNACIONES --}}
    <div class="font-16" id="table-5">
        <table class="table-column-5">
            <tbody>
                <tr>
                    <td class="border text-center" colspan="2" style="background-color: #C0C0C0;"><strong>TOTAL ASIGNACIONES &nbsp; &nbsp; &nbsp;{{ formatear_moneda($trabajador->segundaQuincena[0]->total_asignaciones + $trabajador->primeraQuincena[0]->total_asignaciones)}}</strong></td>
                </tr>
                <tr>
                    <td class=" text-center" colspan="2" >&nbsp; &nbsp; &nbsp;</td>
                </tr>
                <tr>
                    <td class=" text-center" colspan="2" >&nbsp; &nbsp; &nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2" style="border-top: solid 1px;"><strong>COORDINADOR DE NOMINA (FUNDASALUD)</strong></td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2" ><strong>Teléfono: 0272-2367015</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- TOTAL DEDUCCIONES --}}
    <div class="font-16" id="table-6">
        <table class="table-column-6">
            <tbody>
                <tr>
                    <td class="border text-center" colspan="2" style="background-color: #C0C0C0;"><strong>TOTAL DEDUCCIONES &nbsp; &nbsp; &nbsp;{{ formatear_moneda($trabajador->segundaQuincena[0]->total_deduciones + $trabajador->primeraQuincena[0]->total_deduciones) }}</strong></td>
                </tr>
                <tr>
                    <td class="border text-center" colspan="2" style="background-color: #C0C0C0;"><strong>TOTAL NETO PAGADO &nbsp; &nbsp; &nbsp;{{formatear_moneda(($trabajador->segundaQuincena[0]->total_asignaciones + $trabajador->primeraQuincena[0]->total_asignaciones) - ($trabajador->segundaQuincena[0]->total_deduciones + $trabajador->primeraQuincena[0]->total_deduciones))}}</strong></td>
                </tr>

                <tr>
                    <td class="text-center" colspan="2" style="font-size: 10px;"><strong>FECHA Y HORA DE IMPRESIÓN {{$fecha->format('d')}} de {{$mes}} de {{$fecha->format('Y')}} - {{$fecha->format('H:i')}}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="img-qrcode">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(95)->generate($ruta)) !!} ">
    </div>



</body>
</html>