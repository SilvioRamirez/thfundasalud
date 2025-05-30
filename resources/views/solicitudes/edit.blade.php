@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Editar Solicitud #{{ $solicitud->id }}</h1>
@stop

@section('content')

@include('fragment.messages')

@if($solicitud->documentos->count() > 0)
<div class="card mb-3">
    <div class="card-header bg-info">
        <h5 class="mb-0"><i class="fa fa-file"></i> Documentos Actuales</h5>
    </div>
    <div class="card-body">
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
                            <form action="{{ route('solicitudes.documentos.destroy', $documento) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('¿Está seguro de eliminar este documento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header bg-primary">
        <div class="float-end">
            <a href="{{ route('solicitudes.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('solicitudes.update', ['solicitude' => $solicitud->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_solicitud_id" class="form-label">Tipo de Solicitud <span class="text-danger">*</span></label>
                        <select class="form-control @error('tipo_solicitud_id') is-invalid @enderror" 
                                id="tipo_solicitud_id" name="tipo_solicitud_id" required>
                            <option value="">Seleccione un tipo de solicitud</option>
                            @foreach($tiposSolicitud as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_solicitud_id', $solicitud->tipo_solicitud_id) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_solicitud_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select class="form-control @error('estado') is-invalid @enderror" 
                                id="estado" name="estado" required>
                            <option value="pendiente" {{ old('estado', $solicitud->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ old('estado', $solicitud->estado) == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="aprobada" {{ old('estado', $solicitud->estado) == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                            <option value="rechazada" {{ old('estado', $solicitud->estado) == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion" class="form-label">Descripción de la Solicitud <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="5" required 
                                  placeholder="Describa detalladamente su solicitud...">{{ old('descripcion', $solicitud->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                  id="observaciones" name="observaciones" rows="3" 
                                  placeholder="Observaciones adicionales...">{{ old('observaciones', $solicitud->observaciones) }}</textarea>
                        @error('observaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="documentos" class="form-label">Agregar Nuevos Documentos</label>
                        <input type="file" class="form-control @error('documentos.*') is-invalid @enderror" 
                               id="documentos" name="documentos[]" multiple 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted">
                            Puede subir múltiples archivos adicionales. Formatos permitidos: PDF, DOC, DOCX, JPG, JPEG, PNG. 
                            Tamaño máximo por archivo: 10MB
                        </small>
                        @error('documentos.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div id="preview-documentos" class="mt-3"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Actualizar Solicitud
                    </button>
                    <a href="{{ route('solicitudes.show', ['solicitude' => $solicitud->id]) }}" class="btn btn-info">
                        <i class="fa fa-eye"></i> Ver Detalle
                    </a>
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('documentos').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-documentos');
    preview.innerHTML = '';
    
    if (e.target.files.length > 0) {
        const title = document.createElement('h6');
        title.textContent = 'Nuevos archivos seleccionados:';
        title.className = 'text-muted';
        preview.appendChild(title);
        
        Array.from(e.target.files).forEach(file => {
            const fileDiv = document.createElement('div');
            fileDiv.className = 'alert alert-info d-flex justify-content-between align-items-center';
            
            const fileInfo = document.createElement('span');
            fileInfo.innerHTML = `<i class="fa fa-file"></i> ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            
            fileDiv.appendChild(fileInfo);
            preview.appendChild(fileDiv);
        });
    }
});
</script>
@endpush 