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
                            <input type="text" class="form-control @error('ubicacion_fisica') is-invalid @enderror" id="ubicacion_fisica" name="ubicacion_fisica" value="{{ $ubicacionFisica->ubicacion_fisica }}">
                            @error('ubicacion_fisica')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Observación</label>
                        <div class="col-md-6">
                            <input type="observacion" class="form-control @error('observacion') is-invalid @enderror" id="observacion" name="observacion" value="{{ $ubicacionFisica->observacion }}">
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
