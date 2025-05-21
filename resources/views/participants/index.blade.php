@extends('layouts.app')

@section('title', content: 'Participación')

@section('content_header')
    <h1 class="text-center">Participación en Procesos</h1>
@stop

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    @include('fragment.messages')

    @if ($elecciones->isEmpty())
        <div class="alert alert-info">
            No hay elecciones activas en este momento.
        </div>
    @else
        @foreach ($elecciones as $eleccion)
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 position-relative">
                <div
                    class="card col-md-12 col-lg-12 col-sm-12 col-xs-12 p-0 position-absolute top-0 start-50 translate-middle-x">
                    <div class="card-header bg-primary">

                        <h3 class="text-center"><strong>{{ $eleccion->nombre }}</strong></h3>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center mt-0"><strong>Fecha de Inicio:</strong> {{ $eleccion->fecha_inicio }}</h4>
                        <h4 class="text-center mt-4"><strong>Fecha de Fin:</strong> {{ $eleccion->fecha_fin }}</h4>
                        <h4 class="text-center mt-4"><strong>Estatus:</strong> <span
                                class="badge bg-{{ $eleccion->status == 'activo' ? 'success' : 'danger' }}">{{ $eleccion->status }}</span>
                        </h4>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('elecciones.formulario', $eleccion->id) }}" class="btn btn-primary">
                                <i class="fa fa-user-plus"></i> Registrar Participación
                            </a>
                            <a href="{{ route('eleccion.usuario.excel', ['eleccionId' => $eleccion->id, 'userId' => Auth::id()]) }}" 
                                class="btn btn-success">
                                <i class="fa fa-file-excel"></i> Mis Registros Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection

