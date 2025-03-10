<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>

{ 
    margin: 0; 
    padding: 0
} 

html { 
    height: 100%
} 

h2{ 
    color: #0da5b4; 
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
    $mesrecibo = $meses[$primeraQuincena->mes];
@endphp

        <div id="app">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card border-light mb-3 mt-4 shadow">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('storage/img/fundasalud.png') }}" class="rounded" style="display: inline-block" alt="..." width="250" >
                                    </div>
                                    <hr>
                                    <h2 class="text-center">FUNDASALUD TRUJILLO</h2>
                                    <h4 class="text-center">TALENTO HUMANO</h4>

                                        <div class="alert alert-dismissible alert-info" bis_skin_checked="1">
                                            <p class="text-justify">El recibo de pago de <strong>{{$trabajadorCedula->nombre}}</strong> para el Mes de <strong>{{$mesrecibo}}</strong> del Año <strong>{{$primeraQuincena->ano}}</strong> es legítimo. <i class="fa fa-check"></i></p>
                                            <strong>Cedula: </strong>{{$trabajadorCedula->cedula}}
                                            <br>
                                            <strong>Fecha de Ingreso: </strong>{{$trabajadorCedula->fecha_ingreso}}
                                            <br>
                                            <strong>Cargo: </strong>{{$trabajadorCedula->cargo}}
                                            <br>
                                            <strong>Total Asignaciones: </strong>{{formatear_moneda($totalAsignaciones)}}
                                        
                                        </div>

                                        <p class="text-center lead">Para mas información puede dirigirse a la Oficina de Talento Humano</p>

                                    <hr>
                                    <a href="{{ url('/') }}" class="btn btn-success btn-sm"><i class="fa fa-home"></i> Inicio</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<script type="module">


</script>
</body>
</html>
