@extends('layouts.app')

@section('title', content: 'Registros por Usuario')

@section('content_header')
    <h1 class="text-center">Registros de Participación - {{ $eleccion->nombre }}</h1>
    <p class="text-center text-muted">Registros realizados por: {{ $usuario->name }} - {{ $usuario->ubicacion_fisica_name }}</p>
@stop

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="float-start text-white">
                            <i class="fa fa-list"></i> Listado de Registros
                        </div>
                        <div class="float-end">
                            <a href="{{ route('eleccions.estadisticas', $eleccion->id) }}" class="btn btn-light btn-sm">
                                <i class="fa fa-arrow-left"></i> Volver a Estadísticas
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($registros->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Cédula</th>
                                            <th>Cargo</th>
                                            <th>Dependencia</th>
                                            <th>Fecha de Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($registros as $index => $registro)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $registro->nombre }}</td>
                                                <td>{{ $registro->cedula }}</td>
                                                <td>{{ $registro->cargo }}</td>
                                                <td>{{ $registro->dependencia }}</td>
                                                <td>{{ \Carbon\Carbon::parse($registro->fecha_registro)->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                No se encontraron registros para este usuario en la elección actual.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="float-start text-white">
                            <i class="fa fa-info-circle"></i> Resumen de Registros
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fa fa-user-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Registros</span>
                                        <span class="info-box-number">{{ $registros->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary"><i class="fa fa-building"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Ubicación Usuario</span>
                                        <span class="info-box-number">{{ $usuario->ubicacion_fisica_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fa fa-calendar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Elección</span>
                                        <span class="info-box-number">{{ $eleccion->nombre }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 