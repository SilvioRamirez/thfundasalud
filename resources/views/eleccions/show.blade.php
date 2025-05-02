@extends('layouts.app')

@section('title', content: 'Elecciones')

@section('content_header')
    <h1 class="text-center">Administración de Elecciones</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Ver Eleccion
                </div>
                <div class="float-end">
                    <a href="{{ route('eleccions.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <strong>{{ __('Eleccion')}}</strong>
                    {{ $eleccion->nombre }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Fecha de Inicio')}}</strong>
                    {{ $eleccion->fecha_inicio }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Fecha de Fin')}}</strong>
                    {{ $eleccion->fecha_fin }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Estatus')}}</strong>
                    {{ $eleccion->status }}
                </div>
                


            </div>
        </div>

@endsection
