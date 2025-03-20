@extends('layouts.appauth')

@section('title', 'Registro')

@section('content')

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-light mb-3 mt-2 shadow">
                {{-- <div class="card-header bg-primary text-white"><i class="fa fa-user-plus"></i> {{ __('Register') }}</div> --}}

                <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/img/fundasalud.png') }}" class="rounded" style="display: inline-block" alt="..." width="200" >
                        </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombres y Apellidos</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cedula" class="col-md-4 col-form-label text-md-end">Cedula</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula">

                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono">

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ubicacion_fisica" class="col-md-4 col-form-label text-md-end text-start">Ubicación Física</label>
                            <div class="col-md-6">           
                                <select name="ubicacion_fisica_id" id="ubicacion_fisica_id" class="form-select @error('ubicacion_fisica_id') is-invalid @enderror" aria-label="Ubicación Física" required>
                                    <option value="">--- Seleccione  ---</option>
                                    @foreach($ubicacion_fisicas as $id => $ubicacion_fisica)
                                    
                                        <option value="{{ $id }}" {{ $id == old('ubicacion_fisica_id') ? 'selected' : '' }}>
                                            {{ $ubicacion_fisica }}
                                        </option>

                                    @endforeach
                                </select>

                                @error('ubicacion_fisica_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-user-plus"></i> {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        {{-- <input type="text" name="g-recaptcha-response" id="g-recaptcha-response">
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ env('NOCAPTCHA_SITEKEY') }}"></script>

    <script>
        document.addEventListener('submit', function(e)) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ env('NOCAPTCHA_SITEKEY') }}', {action: 'submit'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    let form = e.target();
                    form.submit();
                });
            });
        }
    </script> --}}

    <script type="module">

        IMask(document.getElementById('telefono'),{
            mask: '0000-0000000'
        })

        IMask(document.getElementById('cedula'),{
            mask: '0000000000',
            prepareChar: str => str.toUpperCase(),
            definitions: {
                // <any single char>: <same type as mask (RegExp, Function, etc.)>
                // defaults are '0', 'a', '*'
                'v': /[V,J,G,E,P]/
            }
        })

    </script>
    
@endpush