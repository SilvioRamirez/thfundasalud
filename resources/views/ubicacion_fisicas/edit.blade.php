@extends('layouts.app')

@section('title', content: 'Ubicaciones Físicas')

@section('content_header')
    <h1 class="text-center">Administración de Ubicaciones Físicas</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Editar Ubicación Física
                </div>
                <div class="float-end">
                    <a href="{{ route('ubicacion_fisicas.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ubicacion_fisicas.update', $ubicacionFisica->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Ubicación Física</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('ubicacion_fisica') is-invalid @enderror" id="ubicacion_fisica" name="ubicacion_fisica" value="{{ old('ubicacion_fisica', $ubicacionFisica->ubicacion_fisica) }}">
                            @error('ubicacion_fisica')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="coordinador" class="col-md-4 col-form-label text-md-end text-start">Nombres y Apellidos del Coordinador</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('coordinador') is-invalid @enderror" id="coordinador" name="coordinador" value="{{ old('coordinador', $ubicacionFisica->coordinador) }}">
                            @error('coordinador')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="titulo" class="col-md-4 col-form-label text-md-end text-start">Título del Coordinador</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $ubicacionFisica->titulo) }}">
                            @error('titulo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cedula" class="col-md-4 col-form-label text-md-end text-start">Cédula del Coordinador</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" name="cedula" value="{{ old('cedula', $ubicacionFisica->cedula) }}">
                            @error('cedula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-end text-start">Teléfono del Coordinador</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $ubicacionFisica->telefono) }}">
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="correo" class="col-md-4 col-form-label text-md-end text-start">Correo de la Coordinación</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo', $ubicacionFisica->correo) }}">
                            @error('correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="constancia" class="col-md-4 col-form-label text-md-end text-start">Genera Constancia</label>
                        <div class="col-md-6">
                            <input type="checkbox" class="mt-2 form-check-input @error('constancia') is-invalid @enderror" id="constancia" name="constancia" value="1" {{ $ubicacionFisica->constancia ? 'checked' : '' }}>
                            @error('constancia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Observación</label>
                        <div class="col-md-6">
                            <input type="observacion" class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" value="{{ old('observacion', $ubicacionFisica->observacion) }}">
                            @error('observacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Ubicación Física">
                    </div>
                    
                </form>
            </div>
        </div>

@endsection
