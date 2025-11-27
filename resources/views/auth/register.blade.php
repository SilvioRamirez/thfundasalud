<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
    
    <title>Registro - FUNDASALUD Trujillo</title>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .register-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .register-header {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .register-header::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
        
        .register-header img {
            max-width: 200px;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
            position: relative;
            z-index: 1;
        }
        
        .register-header h2 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }
        
        .register-header p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .register-body {
            padding: 40px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }
        
        .form-group-full {
            grid-column: 1 / -1;
        }
        
        .form-group-custom {
            margin-bottom: 0;
        }
        
        .form-label-custom {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-label-custom .required {
            color: #dc2626;
            margin-left: 3px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
            z-index: 2;
        }
        
        .form-control-custom {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .form-control-custom:focus {
            outline: none;
            border-color: #16a34a;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
        }
        
        .form-control-custom.is-invalid,
        .form-select-custom.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }
        
        .form-select-custom {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            cursor: pointer;
        }
        
        .form-select-custom:focus {
            outline: none;
            border-color: #16a34a;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
        }
        
        .invalid-feedback,
        .text-danger {
            display: block;
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 6px;
        }
        
        .password-requirements {
            background: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .password-requirements h6 {
            color: #15803d;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .password-requirements ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .password-requirements li {
            color: #166534;
            font-size: 0.85rem;
            margin-bottom: 5px;
            padding-left: 20px;
            position: relative;
        }
        
        .password-requirements li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #16a34a;
            font-weight: bold;
        }
        
        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
            margin-top: 10px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4);
            background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }
        
        .login-link p {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        
        .btn-login-link {
            display: inline-block;
            color: #dc2626;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding: 10px 25px;
            border: 2px solid #dc2626;
            border-radius: 8px;
        }
        
        .btn-login-link:hover {
            background: #dc2626;
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .register-body {
                padding: 30px 20px;
            }
            
            .register-header h2 {
                font-size: 1.6rem;
            }
        }
        
        @media (max-width: 576px) {
            .register-container {
                padding: 10px;
            }
            
            .register-header {
                padding: 30px 20px;
            }
            
            .register-body {
                padding: 25px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <img src="{{ asset('storage/img/fundasalud.png') }}" alt="Fundasalud Trujillo">
                <h2>Crear Cuenta Nueva</h2>
                <p>Completa el formulario para registrarte en el sistema</p>
            </div>
            
            <div class="register-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-grid">
                        <!-- Nombres y Apellidos -->
                        <div class="form-group-custom form-group-full">
                            <label for="name" class="form-label-custom">
                                Nombres y Apellidos <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-user input-icon"></i>
                                <input 
                                    id="name" 
                                    type="text" 
                                    class="form-control-custom @error('name') is-invalid @enderror" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autocomplete="name" 
                                    autofocus
                                    placeholder="Ingresa tu nombre completo">
                                
                                @error('name')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="form-group-custom">
                            <label for="email" class="form-label-custom">
                                Correo Electrónico <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-envelope input-icon"></i>
                                <input 
                                    id="email" 
                                    type="email" 
                                    class="form-control-custom @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email"
                                    placeholder="correo@ejemplo.com">
                                
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Cédula -->
                        <div class="form-group-custom">
                            <label for="cedula" class="form-label-custom">
                                Cédula <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-id-card input-icon"></i>
                                <input 
                                    id="cedula" 
                                    type="text" 
                                    class="form-control-custom @error('cedula') is-invalid @enderror" 
                                    name="cedula" 
                                    value="{{ old('cedula') }}" 
                                    required 
                                    autocomplete="cedula"
                                    placeholder="0000000000">
                                
                                @error('cedula')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Teléfono -->
                        <div class="form-group-custom">
                            <label for="telefono" class="form-label-custom">
                                Teléfono <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-phone input-icon"></i>
                                <input 
                                    id="telefono" 
                                    type="text" 
                                    class="form-control-custom @error('telefono') is-invalid @enderror" 
                                    name="telefono" 
                                    value="{{ old('telefono') }}" 
                                    required 
                                    autocomplete="telefono"
                                    placeholder="0000-0000000">
                                
                                @error('telefono')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Ubicación Física -->
                        <div class="form-group-custom">
                            <label for="ubicacion_fisica_id" class="form-label-custom">
                                Ubicación Física <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-map-marker-alt input-icon"></i>
                                <select 
                                    name="ubicacion_fisica_id" 
                                    id="ubicacion_fisica_id" 
                                    class="form-select-custom @error('ubicacion_fisica_id') is-invalid @enderror" 
                                    required>
                                    <option value="">--- Seleccione ---</option>
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
                        
                        <!-- Password Requirements -->
                        <div class="form-group-full">
                            <div class="password-requirements">
                                <h6><i class="fa fa-info-circle"></i> Requisitos de la contraseña:</h6>
                                <ul>
                                    <li>Mínimo 8 caracteres</li>
                                    <li>Debe contener letras y números</li>
                                    <li>Se recomienda usar caracteres especiales</li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Contraseña -->
                        <div class="form-group-custom">
                            <label for="password" class="form-label-custom">
                                Contraseña <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-lock input-icon"></i>
                                <input 
                                    id="password" 
                                    type="password" 
                                    class="form-control-custom @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Mínimo 8 caracteres">
                                
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Confirmar Contraseña -->
                        <div class="form-group-custom">
                            <label for="password-confirm" class="form-label-custom">
                                Confirmar Contraseña <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="fa fa-lock input-icon"></i>
                                <input 
                                    id="password-confirm" 
                                    type="password" 
                                    class="form-control-custom" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Repite tu contraseña">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botón Registrar -->
                    <button type="submit" class="btn-register">
                        <i class="fa fa-user-plus"></i> Crear Cuenta
                    </button>
                    
                    <!-- Link a Login -->
                    <div class="login-link">
                        <p>¿Ya tienes una cuenta?</p>
                        <a href="{{ route('login') }}" class="btn-login-link">
                            <i class="fa fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="module">
        // IMask para el teléfono
        IMask(document.getElementById('telefono'), {
            mask: '0000-0000000'
        });

        // IMask para la cédula
        IMask(document.getElementById('cedula'), {
            mask: '0000000000',
            prepareChar: str => str.toUpperCase(),
            definitions: {
                'v': /[V,J,G,E,P]/
            }
        });

        // Validación de confirmación de contraseña
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password-confirm');

        passwordConfirm.addEventListener('input', function() {
            if (password.value !== passwordConfirm.value) {
                passwordConfirm.setCustomValidity('Las contraseñas no coinciden');
            } else {
                passwordConfirm.setCustomValidity('');
            }
        });
    </script>
</body>
</html>