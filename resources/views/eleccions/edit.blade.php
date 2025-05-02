@extends('layouts.app')

@section('title', content: 'Elecciones')

@section('content_header')
    <h1 class="text-center">Administración de Elecciones</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Editar Eleccion
                </div>
                <div class="float-end">
                    <a href="{{ route('eleccions.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('eleccions.update', $eleccion->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">      
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $eleccion->nombre }}">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="fecha_inicio" class="col-md-4 col-form-label text-md-end text-start">Fecha de Inicio</label>
                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{ $eleccion->fecha_inicio }}">
                            @error('fecha_inicio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="fecha_fin" class="col-md-4 col-form-label text-md-end text-start">Fecha de Fin</label>
                        <div class="col-md-6">
                            <input type="datetime-local" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{ $eleccion->fecha_fin }}">
                            @error('fecha_fin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                        <div class="col-md-6">
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="planificado" {{ $eleccion->status == 'planificado' ? 'selected' : '' }}>Planificado</option>
                                <option value="activo" {{ $eleccion->status == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="finalizado" {{ $eleccion->status == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Elección">
                    </div>
                    
                </form>
            </div>
        </div>

@endsection
