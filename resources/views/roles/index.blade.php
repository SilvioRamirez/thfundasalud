@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Administración de Roles</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-user')
            <div class="float-start">
                <a href="{{ route('roles.create') }}" class="btn btn-light btn-sm"><i class="fa fa-user-plus"></i> {{ __('Agregar Nuevo Rol') }}</a>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('roles.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-user')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
