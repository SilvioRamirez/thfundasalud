@extends('layouts.appauth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar su correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo link de verificación ha sido enviado a su correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifica tu dirección de correo electrónico para enviarte el link.') }}
                    {{ __('Si no has recibido el correo electrónico') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aqui para solicitar de nuevo') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
