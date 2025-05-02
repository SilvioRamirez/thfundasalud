@extends('layouts.app')

@section('title', content: 'Participación')

@section('content_header')
    <h1 class="text-center">Registro de Participantes</h1>
@stop

@section('content')

    @include('fragment.messages')

    @if ($eleccion)
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 position-relative">
            <div
                class="card col-md-12 col-lg-12 col-sm-12 col-xs-12 p-0 position-absolute top-0 start-50 translate-middle-x">
                <div class="card-header bg-primary">

                    <h3 class="text-center"><strong>{{ $eleccion->nombre }}</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('participacion.register', $eleccion->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="cedula">Cédula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                        </div>

                </div>
                <div class="container-fluid mt-0">
                    <div class="alert alert-dismissible alert-info" bis_skin_checked="1">
                        Por favor, registra la partición del trabajador ingresando su <strong>Cédula</strong> aquí.
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-user-plus"></i> Registrar Participación
                    </button>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script type="module">
        IMask(document.getElementById('cedula'), {
            mask: '0000000000',
            prepareChar: str => str.toUpperCase(),
        })
    </script>
@endpush
