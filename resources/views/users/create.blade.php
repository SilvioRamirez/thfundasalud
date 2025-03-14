@extends('layouts.app')

@section('title', content: 'Usuarios')

@section('content_header')
    <h1 class="text-center">Administración de Usuarios</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-plus"></i> Agregar Nuevo Usuario
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">{{ __( 'Name') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="cedula" class="col-md-4 col-form-label text-md-end text-start">{{ __( 'Cedula') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" name="cedula">
                            @error('cedula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-end text-start">{{ __( 'Teléfono') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono">
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Ubicación Física</label>
                        <div class="col-md-6">           
                            {{-- <select class="form-select @error('ubicacion_fisica') is-invalid @enderror" aria-label="Ubicación Física" id="ubicacion_fisica" name="ubicacion_fisica">
                                @forelse ($ubicacion_fisicas as $ubicacion_fisica)

                                        <option value="{{ $ubicacion_fisica }}" {{ $ubicacion_fisica == old('ubicacion_fisica') ? 'selected' : '' }}>
                                            {{ $ubicacion_fisica }}
                                        </option>
                                @empty
                                @endforelse
                            </select> --}}
                            <select name="ubicacion_fisica_id" id="ubicacion_fisica_id" class="form-select @error('ubicacion_fisica_id') is-invalid @enderror" aria-label="Ubicación Física" required>
                                <option value="">--- Seleccione  ---</option>
                                @foreach($ubicacion_fisicas as $id => $ubicacion_fisica)
                                
                                    <option value="{{ $id }}" {{ $id == old('ubicacion_fisica_id') ? 'selected' : '' }}>
                                        {{ $ubicacion_fisica }}
                                    </option>

                                @endforeach
                            </select>

                            @error('ubicacion_fisica_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                        <div class="col-md-6">           
                            <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                                @forelse ($roles as $role)

                                    @if ($role!='Super Admin')
                                        <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                        {{ $role }}
                                        </option>
                                    @else
                                        @if (Auth::user()->hasRole('Super Admin'))   
                                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role }}
                                            </option>
                                        @endif
                                    @endif

                                @empty

                                @endforelse
                            </select>
                            @error('roles')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar Usuario">
                    </div>

                </form>
            </div>
        </div>

@endsection
