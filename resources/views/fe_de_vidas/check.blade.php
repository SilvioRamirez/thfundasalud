@extends('layouts.app')

@section('title', content: 'Revisar Cedula - Fe de Vida')

@section('content_header')
    <h1 class="text-center">Revisar Cedula - Fe de Vida</h1>
@stop

@section('content')

@include('fragment.messages')

        <div class="card">
            <div class="card-header bg-primary">
                <div class="float-start">
                    <i class="fa fa-user-check"></i> Verificar cedula
                </div>
                <div class="float-end">
                    <a href="{{ route('home') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('fe_de_vidas.check.cedula') }}" method="post">
                    @csrf
                    <div class="mb-3 row">

                        <label for="cedula" class="col-md-4 col-form-label text-md-end text-start">{{ __( 'Cedula') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" name="cedula" placeholder="0000000000">
                            <p class="small text-muted p-1 m-1">Por favor, ingresa la cédula del trabajador para verificar su información.</p>
                            @error('cedula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Verificar">
                    </div>

                </form>
            </div>
        </div>

@endsection

@push('scripts')
    <script type="module">
        IMask(document.getElementById('cedula'), {
            mask: '0000000000',
            prepareChar: str => str.toUpperCase(),
        })
    </script>
@endpush