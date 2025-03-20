@extends('layouts.app')

@section('title', content: 'Usuarios')

@section('content_header')
    <h1 class="text-center">Administración de Usuarios</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Ver Usuario
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <strong>{{ __('Name')}}</strong>
                    {{ $user->name }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Cedula')}}</strong>
                    {{ $user->cedula }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Teléfono')}}</strong>
                    {{ $user->telefono }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Email')}}</strong>
                    {{ $user->email }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Ubicación Física')}}</strong>
                    {{ $user->ubicacionFisicaName }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Roles')}}</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <span class="badge bg-success">{{ $v }}</span>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <strong>{{ __('Creado el')}}</strong>
                    {{ $user->created_at }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Actualizado el')}}</strong>
                    {{ $user->updated_at }}
                </div>
            </div>
        </div>

@endsection
