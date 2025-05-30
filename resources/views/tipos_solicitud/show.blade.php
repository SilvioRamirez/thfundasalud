@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Detalle del Tipo de Solicitud</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary">
        <div class="float-end">
            <a href="{{ route('tipos-solicitud.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>ID:</strong></label>
                    <p>{{ $tipoSolicitud->id }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Estado:</strong></label>
                    <p>
                        @if($tipoSolicitud->activo)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label"><strong>Nombre:</strong></label>
                    <p>{{ $tipoSolicitud->nombre }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label"><strong>Descripción:</strong></label>
                    <p>{{ $tipoSolicitud->descripcion ?? 'Sin descripción' }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Fecha de Creación:</strong></label>
                    <p>{{ $tipoSolicitud->created_at ? \Carbon\Carbon::parse($tipoSolicitud->created_at)->format('d/m/Y H:i:s') : 'N/A' }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Última Actualización:</strong></label>
                    <p>{{ $tipoSolicitud->updated_at ? \Carbon\Carbon::parse($tipoSolicitud->updated_at)->format('d/m/Y H:i:s') : 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                @can('edit-tipo-solicitud')
                    <a href="{{ route('tipos-solicitud.edit', ['tipos_solicitud' => $tipoSolicitud->id]) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                @endcan
                <a href="{{ route('tipos-solicitud.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>

@endsection 