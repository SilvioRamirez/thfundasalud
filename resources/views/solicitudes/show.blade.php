@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Detalle de la Solicitud #{{ $solicitud->id }}</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary">
        <div class="float-end">
            <a href="{{ route('solicitudes.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>ID de Solicitud:</strong></label>
                    <p>{{ $solicitud->id }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Estado:</strong></label>
                    <p>
                        @switch($solicitud->estado)
                            @case('pendiente')
                                <span class="badge badge-warning">Pendiente</span>
                                @break
                            @case('en_proceso')
                                <span class="badge badge-info">En Proceso</span>
                                @break
                            @case('aprobada')
                                <span class="badge badge-success">Aprobada</span>
                                @break
                            @case('rechazada')
                                <span class="badge badge-danger">Rechazada</span>
                                @break
                            @default
                                <span class="badge badge-secondary">{{ $solicitud->estado }}</span>
                        @endswitch
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Usuario Solicitante:</strong></label>
                    <p>{{ $solicitud->usuario->name ?? 'N/A' }}</p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Tipo de Solicitud:</strong></label>
                    <p>{{ $solicitud->tipoSolicitud->nombre ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label"><strong>Descripción:</strong></label>
                    <div class="border p-3 bg-light">
                        {{ $solicitud->descripcion }}
                    </div>
                </div>
            </div>
        </div>
        
        @if($solicitud->observaciones)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label"><strong>Observaciones:</strong></label>
                    <div class="border p-3 bg-light">
                        {{ $solicitud->observaciones }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Fecha de Solicitud:</strong></label>
                    <p>{{ $solicitud->created_at }}</p>
                </div>
            </div>
            
            @if($solicitud->fecha_respuesta)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label"><strong>Fecha de Respuesta:</strong></label>
                    <p>{{ $solicitud->fecha_respuesta }}</p>
                </div>
            </div>
            @endif
        </div>
        
        @if($solicitud->documentos->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label"><strong>Documentos Adjuntos:</strong></label>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre del Archivo</th>
                                    <th>Tamaño</th>
                                    <th>Fecha de Subida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitud->documentos as $documento)
                                <tr>
                                    <td>
                                        <i class="fa fa-file"></i> {{ $documento->nombre_original }}
                                    </td>
                                    <td>{{ $documento->tamano_formateado }}</td>
                                    <td>{{ $documento->created_at ? \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('solicitudes.documentos.download', $documento) }}" 
                                           class="btn btn-sm btn-primary" title="Descargar">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        @can('edit-solicitud')
                                        <form action="{{ route('solicitudes.documentos.destroy', $documento) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('¿Está seguro de eliminar este documento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                @can('edit-solicitud')
                    <a href="{{ route('solicitudes.edit', ['solicitude' => $solicitud->id]) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                @endcan
                <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>

@endsection 