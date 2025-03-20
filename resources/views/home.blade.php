@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"> --}}
            <div class="card mt-4">
                <div class="card-header bg-primary">{{ __('Panel de Control') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenid@ <strong>{{ auth()->user()->name }}</strong> {{ __('¡Has iniciado sesión!') }}
                    <hr>

                    @can('view-trabajador')
                        <a class="btn btn-primary" href="{{ route('user.recibo.index') }}"><i class="fa fa-file-invoice"></i> Recibos de Pago</a>
                    @endcan

                    
                    @canany(['create-user', 'edit-user', 'delete-user'])
                        <a class="btn btn-success" href="{{ route('users.index') }}"> <i class="fa fa-users"></i> Administración de Usuarios</a>
                    @endcanany
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> <i class="fa fa-users-cog"></i> Administración de Roles</a>
                    @endcanany
                    <p>&nbsp;</p>
                </div>
            </div>
{{--         </div>
    </div>
</div> --}}
@endsection
