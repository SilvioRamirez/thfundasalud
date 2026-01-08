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
                    Información de Trabajador, Mes: {{$trabajador->mes}} Año: {{$trabajador->ano}}
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
                <h2 class="text-center mb-4">Recibos de Pago
                    @can('view-arc')
                        y Planilla ARC
                    @endcan
                </h2>

                <div class="row">
                    <div class="col-md-6">
                        {{ $dataTable->table() }}
                    </div>
                        @php
                            use Carbon\Carbon;
                            $anoActual = Carbon::now()->year;
                            $anoAnterior = $anoActual - 1;
                        @endphp
                    @can('view-arc')
                    <div class="col-md-6">
                        <div class="row justify-content-center">
                                <div class="col-md-8 mb-3">
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
                        </div>
                </div>
                @endcan
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Esperar a que DataTable se inicialice
            setTimeout(function() {
                var table = $('#trabajadorsindividual-table').DataTable();
                
                // Configurar ordenamiento numérico para las columnas de año y mes
                $.fn.dataTable.ext.type.order['num-pre'] = function(data) {
                    // Convertir a número, manejar valores vacíos
                    var num = parseFloat(data) || 0;
                    return num;
                };
                
                // Forzar reordenamiento inicial
                table.order([0, 'desc'], [1, 'desc']).draw();
            }, 500);
        });
    </script>
@endpush