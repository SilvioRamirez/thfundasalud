@extends('layouts.app')

@section('title', content: 'Ubicaciones Físicas')

@section('content_header')
    <h1 class="text-center">Administración de Ubicaciones Físicas</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-pen"></i> Ver Ubicación Física
                </div>
                <div class="float-end">
                    <a href="{{ route('ubicacion_fisicas.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <strong>{{ __('Ubicación Física')}}</strong>
                    {{ $ubicacionFisica->ubicacion_fisica }}
                </div>
                <div class="form-group">
                    <strong>{{ __('Observación')}}</strong>
                    {{ $ubicacionFisica->observacion }}
                </div>

            </div>
        </div>

@endsection
