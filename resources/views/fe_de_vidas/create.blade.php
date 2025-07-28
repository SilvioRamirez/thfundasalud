@extends('layouts.app')

@section('title', content: 'Usuarios')

@section('content_header')
    <h1 class="text-center">Registro de Fe de Vida</h1>
@stop

@section('content')

@include('fragment.messages')
        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-plus"></i> Registrar nueva fe de vida
                </div>
                <div class="float-end">
                    <a href="{{ route('fe_de_vidas.check') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('fe_de_vidas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden fields required by the controller -->
                    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
                    
                    <div class="row">
                        <span class="col-md-4 text-md-end text-start">Nombres y Apellidos:</span>
                        <p class="col-md-6"> <strong>{{ $trabajador->nombre }}</strong></p>
                    </div>

                    <div class="row">
                        <span class="col-md-4 text-md-end text-start">Cédula:</span>
                        <p class="col-md-6"> <strong>{{ $trabajador->cedula }}</strong></p>
                    </div>

                    <div class="row">
                        <span class="col-md-4 text-md-end text-start">Cargo:</span>
                        <p class="col-md-6"> <strong>{{ $trabajador->cargo }}</strong></p>
                    </div>

                    <div class="row">
                        <span class="col-md-4 text-md-end text-start">Código de Nomina:</span>
                        <p class="col-md-6"> <strong>{{ $trabajador->codigo_rac }}</strong></p>
                    </div>

                    <div class="mb-3 row">
                        <label for="municipio_id" class="col-md-4 col-form-label text-md-end text-start">Municipio</label>
                        <div class="col-md-6">
                            <select name="municipio_id" id="municipio_id" class="form-select @error('municipio_id') is-invalid @enderror" aria-label="Municipio" required>
                                <option value="" selected disabled>--- Seleccione  ---</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->id }}">
                                        {{ $municipio->municipio }}
                                    </option>
                                @endforeach
                            </select>
                            @error('municipio_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="parroquia_id" class="col-md-4 col-form-label text-md-end text-start">Parroquia</label>
                        <div class="col-md-6">
                            <select name="parroquia_id" id="parroquia_id" class="form-select @error('parroquia_id') is-invalid @enderror" aria-label="Parroquia" required>
                                <option value="" selected disabled>--- Seleccione  ---</option>
                                
                            </select>
                            @error('parroquia_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Ubicación Física</label>
                        <div class="col-md-6">           

                            <select name="ubicacion_fisica_id" id="ubicacion_fisica_id" class="form-select @error('ubicacion_fisica_id') is-invalid @enderror" aria-label="Ubicación Física" required>
                                <option value="" selected disabled>--- Seleccione  ---</option>
                                @foreach($ubicacion_fisicas as $id => $ubicacion_fisica)
                                    <option value="{{ $id }}">
                                        {{ $ubicacion_fisica->ubicacion_fisica }}
                                    </option>
                                @endforeach
                            </select>

                            @error('ubicacion_fisica_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ubicacion_fisica_funcion" class="col-md-4 col-form-label text-md-end text-start">Ubicación donde Cumple sus Funciones</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('ubicacion_fisica_funcion') is-invalid @enderror" id="ubicacion_fisica_funcion" name="ubicacion_fisica_funcion">
                            <small class="text-muted">UBICACIÓN FISICA. (DIRECCION - COORDINACION - SERVICIO)</small>
                            @error('ubicacion_fisica_funcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jefe_inmediato_search" class="col-md-4 col-form-label text-md-end text-start">Jefe Inmediato Cedula</label>
                        <div class="col-md-6">
                            <div class="input-group">
                            <input type="text" class="form-control @error('jefe_inmediato_search') is-invalid @enderror" id="jefe_inmediato_search" name="jefe_inmediato_search" placeholder="000000000">
                            <button type="button" class="btn btn-primary" onclick="fetchJefeInmediato()">Buscar</button>
                            </div>
                            @error('jefe_inmediato_search')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jefe_inmediato" class="col-md-4 col-form-label text-md-end text-start">Jefe Inmediato Nombres y Apellidos</label>
                        <div class="col-md-6">
                            <input type="text" disabled class="form-control @error('jefe_inmediato') is-invalid @enderror" id="jefe_inmediato" name="jefe_inmediato">
                            <input type="hidden" id="jefe_inmediato_id" name="jefe_inmediato_id">
                            @error('jefe_inmediato')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="observaciones" class="col-md-4 col-form-label text-md-end text-start">Observación</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('observacion') is-invalid @enderror" id="observaciones" name="observaciones">
                            @error('observaciones')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="image_url" class="col-md-4 col-form-label text-md-end text-start">Adjuntar archivo</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg,.JPG,.PNG,.JPEG">
                            <small class="text-muted">Formatos permitidos: PDF, DOC, DOCX, JPG, JPEG, PNG. Tamaño máximo por archivo: 10MB</small>
                            @error('image_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Registrar Fe de Vida">
                    </div>

                </form>
            </div>
        </div>

@endsection

@push('scripts')

<script>
    
    document.getElementById('municipio_id').addEventListener('change', function() {
        const municipioId = this.value;
        const parroquiaSelect = document.getElementById('parroquia_id');
        parroquiaSelect.innerHTML = '<option value="">--- Seleccione  ---</option>';
        
        fetch(`/api/fetch-parroquias/${municipioId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(parroquia => {
                    const option = document.createElement('option');
                    option.value = parroquia.id;
                    option.textContent = parroquia.parroquia;
                    parroquiaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching parroquias:', error));
    });

    function fetchJefeInmediato() {
        const cedula = document.getElementById('jefe_inmediato_search').value;
        
        // Validar que se haya ingresado una cédula
        if (!cedula || cedula.trim() === '') {
            Swal.fire({
                title: 'Advertencia',
                text: 'Por favor ingrese una cédula para buscar',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: "#ffc107",
            });
            return;
        }
        
        fetch(`/api/fetch-jefe-inmediato/${cedula}`)
            .then(response => response.json())
            .then(data => {
                // Verificar si la respuesta contiene datos válidos
                if (data && data.nombre) {
                    document.getElementById('jefe_inmediato').value = data.nombre;
                    document.getElementById('jefe_inmediato_id').value = data.id;
                    /* Swal.fire({
                        title: 'Éxito',
                        text: 'Jefe inmediato encontrado correctamente',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#28a745",
                        timer: 2000
                    }); */
                } else {
                    // Limpiar el campo si no se encontró nada
                    document.getElementById('jefe_inmediato').value = '';
                    Swal.fire({
                        title: 'No encontrado',
                        text: 'No se encontró ningún trabajador con la cédula: ' + cedula,
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#ffc107",
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching jefe inmediato:', error);
                document.getElementById('jefe_inmediato').value = '';
                Swal.fire({
                    title: 'Error',
                    text: 'Error de conexión al buscar la cédula. Intente nuevamente.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: "#dc3545",
                });
            });
    }
</script>

@endpush
