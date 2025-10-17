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
                            en
                            la Institución:</strong></label>
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
                <h2 class="text-center mb-4">Constancia de Trabajo</h2>

                <form action="{{ route('constancia.pdf', [$trabajador->cedula]) }}" method="post">

                    @csrf
                    <div class="mb-3 row">
                        <label for="nota" class="col-md-4 col-form-label text-md-end text-start">Nota</label>
                        <div class="col-md-6">
                            <select name="nota" id="nota" class="form-control" required>
                                <option value="" selected disabled>--- Seleccione ---</option>
                                <option value="TRÁMITE BANCARIO">TRÁMITE BANCARIO</option>
                                <option value="TRÁMITE PERSONAL">TRÁMITE PERSONAL</option>
                                <option value="TRÁMITE IVSS">TRÁMITE IVSS</option>
                                <option value="TRAMITE FAOV">TRAMITE FAOV</option>
                                <option value="OTROS TRÁMITES">OTROS TRÁMITES</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="turno" class="col-md-4 col-form-label text-md-end text-start">Turno</label>
                        <div class="col-md-6">
                            <select name="turno" id="turno" class="form-control" required>
                                <option value="" selected disabled>--- Seleccione ---</option>
                                <option value="DIURNO">DIURNO</option>
                                <option value="NOCTURNO">NOCTURNO</option>
                                <option value="ROTATIVO">ROTATIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Ubicación
                            Física</label>
                        <div class="col-md-6">
                            <select name="ubicacion_fisica" id="ubicacion_fisica"
                                class="form-select @error('ubicacion_fisica_id') is-invalid @enderror"
                                aria-label="Ubicación Física" required>
                                <option value="" selected disabled>--- Seleccione ---</option>
                                @foreach($ubicacion_fisicas as $id => $ubicacion_fisica)
                                    <option value="{{ $ubicacion_fisica->ubicacion_fisica }}">
                                        {{ $ubicacion_fisica->ubicacion_fisica }}
                                    </option>
                                @endforeach
                            </select>

                            @error('ubicacion_fisica')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa fa-download"></i> Generar Constancia de Trabajo
                        </button>
                    </div>
                </form>

                {{-- <div class="text-center">
                    <a class="btn btn-success btn-lg" title="Generar Constancia de Trabajo"
                        href="{{ route('constancia.pdf', [$trabajador->cedula]) }}">
                        <i class="fa fa-download"></i> Generar Constancia de Trabajo
                    </a>
                </div> --}}

            </div>
        </div>
    </div>

@endsection

@push('scripts')

<script>
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
                        text: 'No coinciden los datos con la cédula: ' + cedula,
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