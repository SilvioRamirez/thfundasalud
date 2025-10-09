@extends('layouts.app')

@section('title', content: 'Configuraciones')

@section('content_header')
    <h1 class="text-center">Administración de Configuraciones</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Editar Configuración
                </div>
                <div class="float-end">
                    <a href="{{ route('settings.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update', $setting->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Clave</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ $setting->key }}">
                            @error('key')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Valor</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ $setting->value }}">
                            @error('value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Tipo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="type" name="type" value="{{ $setting->type }}">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Grupo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="group" name="group" value="{{ $setting->group }}">
                            @error('group')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="name" name="name" value="{{ $setting->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Descripción</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="description" name="description" value="{{ $setting->description }}">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Configuración">
                    </div>
                    
                </form>
            </div>
        </div>

@endsection
