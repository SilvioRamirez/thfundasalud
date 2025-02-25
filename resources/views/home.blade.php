@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Panel de Control') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('¡Has iniciado sesión!') }}

                    <p>Panel de Control.</p>
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <a class="btn btn-primary" href="{{ route('roles.index') }}">
                            <i class="bi bi-person-fill-gear"></i> Administración de Roles</a>
                    @endcanany
                    @canany(['create-user', 'edit-user', 'delete-user'])
                        <a class="btn btn-success" href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i> Administración de Usuarios</a>
                    @endcanany
                    @canany(['create-product', 'edit-product', 'delete-product'])
                        <a class="btn btn-warning" href="{{ route('products.index') }}">
                            <i class="bi bi-bag"></i> Administración de Productos</a>
                    @endcanany
                    @can(['view-product'])
                        <a class="btn btn-warning" href="{{ route('products.index') }}">
                            <i class="bi bi-bag"></i> Ver Productos</a>
                    @endcan
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
