@extends('layouts.app')

@section('title', content: 'Estadísticas de Participación')

@section('content_header')
    <h1 class="text-center">Estadísticas de Participación - {{ $eleccion->nombre }}</h1>
    <p class="text-center text-muted">Mostrando datos de trabajadores: {{ $mes_nombre }} {{ $ano_reciente }}</p>
@stop

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="float-start text-white">
                            <i class="fa fa-chart-pie"></i> Resumen de Participación
                        </div>
                        <div class="float-end">
                            <a href="{{ route('eleccions.index') }}" class="btn btn-light btn-sm">&larr;
                                {{ __('actions.return') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fa fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Participantes</span>
                                        <span class="info-box-number">{{ $trabajadores_participantes }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fa fa-user-slash"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">No Participantes</span>
                                        <span class="info-box-number">{{ $trabajadores_no_participantes }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fa fa-percentage"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Porcentaje Participación</span>
                                        <span class="info-box-number">
                                            {{ number_format(($trabajadores_participantes / ($trabajadores_participantes + $trabajadores_no_participantes)) * 100, 2) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="float-start text-white">
                            <i class="fa fa-info-circle"></i> Información Detallada de Registros por Usuario
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Ubicación Física</th>
                                    <th>Cantidad de Registros</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios_data as $usuario)
                                <tr>
                                    <td>{{ $usuario['nombre'] }}</td>
                                    <td>{{ $usuario['ubicacion'] }}</td>
                                    <td>{{ $usuario['cantidad'] }}</td>
                                    <td>
                                        <a href="{{ route('eleccion.usuario.registros', ['eleccionId' => $eleccion->id, 'userId' => $usuario['id']]) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-list"></i> Ver Registros
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- Primero cargamos la biblioteca Chart.js --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script> --}}
    
    {{-- Luego renderizamos cada gráfico individualmente --}}
            // Renderizamos los gráficos disponibles
            {!! $chart_registros->renderChartJsLibrary() !!}
            {!! $chart_registros->renderJs() !!}
            
            // Renderizamos el gráfico de usuarios
            {!! $chart_usuarios->renderChartJsLibrary() !!}
            {!! $chart_usuarios->renderJs() !!}
@endpush
