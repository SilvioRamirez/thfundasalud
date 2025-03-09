@extends('layouts.app')

@section('title', content: 'Roles')

@section('content')

@section('content_header')
    <h1 class="text-center">Administración de Roles</h1>
@stop
        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-plus"></i> Agregar Nuevo Rol
                </div>
                <div class="float-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="permissions" class="col-md-4 col-form-label text-md-end text-start">Permisos</label>
                        <div class="col-md-6">
                            <fieldset>
                                @foreach ($permissions as $value)
                                    <div class="form-check" bis_skin_checked="1">
                                        <label class="form-check-label" for="">
                                            <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $value->id }}" {{ in_array($value->id, old('permissions') ?? []) ? 'checked' : '' }}>
                                            {{ $value->name  }}
                                        </label>
                                    </div>
                                @endforeach
                            </fieldset>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar Rol">
                    </div>
                    
                </form>
            </div>
        </div>


@endsection