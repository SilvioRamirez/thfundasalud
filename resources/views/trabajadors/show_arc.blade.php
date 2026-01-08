@extends('layouts.app')

@section('title', 'Trabajadores')

@section('content_header')
<h1 class="text-center">Administración de Trabajador</h1>
@stop

@section('content')

    @include('fragment.messages')

    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    Información de Trabajador
                </div>
                @unlessrole('user')
                <div class="float-end">
                    <a href="{{ route('trabajadors.index') }}" class="btn btn-light btn-sm">&larr;
                        {{ __('actions.return') }}</a>
                </div>
                @endunlessrole
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->nombre }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Cedula:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->cedula }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Código
                            RAC:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->codigo_rac }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Cargo:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->cargo }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Dependencia
                            Administrativa:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->dependencia }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Fecha de
                            Ingreso:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->fecha_ingreso }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Años de Servicio
                            en la Institución:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->anos_ingreso }}
                    </div>
                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Años
                            Anteriores:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->anos_anteriores }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Banco:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->banco }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Cuenta:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->cuenta }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Nomina:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $trabajador->nomina }}
                    </div>
                </div>
                <hr>
                <h2 class="text-center mb-4">Planilla ARC</h2>

                @php
                    use Carbon\Carbon;
                    $anoActual = Carbon::now()->year;
                    $anoAnterior = $anoActual - 1;
                @endphp
                <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <div class="card text-center h-100">
                                <div class="card-body">
                                    <h3 class="text-center">{{ $anoAnterior }}</h3>
                                    <p class="card-text">Planilla ARC</p>
                                    <a href="{{ route('recibo.arc.pdf', [$trabajador->cedula, $anoAnterior]) }}" 
                                       class="btn btn-success btn-lg">
                                        <i class="fa fa-download"></i> Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="fa fa-info-circle"></i>
                    <strong>Información:</strong> La Planilla ARC muestra el consolidado anual de sus asignaciones y deducciones de ley.
                </div>
            </div>
        </div>
    </div>

@endsection