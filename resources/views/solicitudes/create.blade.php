@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Crear Nueva Solicitud</h1>
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
        <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_solicitud_id" class="form-label">Tipo de Solicitud <span class="text-danger">*</span></label>
                        <select class="form-control @error('tipo_solicitud_id') is-invalid @enderror" 
                                id="tipo_solicitud_id" name="tipo_solicitud_id" required>
                            <option value="">Seleccione un tipo de solicitud</option>
                            @foreach($tiposSolicitud as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_solicitud_id') == $tipo->id ? 'selected' : '' }}>
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
                        <label class="form-label">Usuario Solicitante</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        <small class="text-muted">La solicitud se registrará a su nombre</small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion" class="form-label">Descripción de la Solicitud <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" name="descripcion" rows="5" required 
                                  placeholder="Describa detalladamente su solicitud...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="documentos" class="form-label">Documentos de Soporte</label>
                        <input type="file" class="form-control @error('documentos.*') is-invalid @enderror" 
                               id="documentos" name="documentos[]" multiple 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted">
                            Puede subir múltiples archivos. Formatos permitidos: PDF, DOC, DOCX, JPG, JPEG, PNG. 
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
                        <i class="fa fa-save"></i> Crear Solicitud
                    </button>
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
        title.textContent = 'Archivos seleccionados:';
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