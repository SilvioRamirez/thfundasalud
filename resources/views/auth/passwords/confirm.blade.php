<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
    
    <title>Confirmar Contraseña - FUNDASALUD Trujillo</title>
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;
        }
        
        /* Lado izquierdo - Información */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 50%, #f87171 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -200px;
            right: -200px;
        }
        
        .login-left::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
        }
        
        .login-left-content {
            text-align: center;
            color: white;
            z-index: 1;
            max-width: 500px;
        }
        
        .login-left-content img {
            max-width: 280px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.2));
        }
        
        .login-left-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .login-left-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.95;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .feature-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 25px;
            margin: 10px 5px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }
        
        /* Lado derecho - Formulario */
        .login-right {
            flex: 1;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .login-form-container {
            width: 100%;
            max-width: 450px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-header h2 {
            color: #1f2937;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #6b7280;
            font-size: 1rem;
        }
        
        .alert-info {
            background: #dbeafe;
            border: 1px solid #3b82f6;
            color: #1e40af;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }
        
        .form-group-custom {
            margin-bottom: 25px;
        }
        
        .form-label-custom {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95rem;
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
            font-size: 1.1rem;
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
        
        .form-control-custom.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }
        
        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 6px;
        }
        
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.4);
            background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password-link {
            color: #16a34a;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .forgot-password-link:hover {
            color: #15803d;
            text-decoration: underline;
        }
        
        .security-badge {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .security-badge i {
            color: #16a34a;
            margin-right: 8px;
        }
        
        .security-badge span {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-left {
                display: none;
            }
            
            .login-right {
                flex: 1;
            }
        }
        
        @media (max-width: 576px) {
            .login-right {
                padding: 20px;
            }
            
            .login-header h2 {
                font-size: 1.6rem;
            }
            
            .login-form-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Lado Izquierdo - Branding -->
        <div class="login-left">
            <div class="login-left-content">
                <img src="{{ asset('storage/img/fundasalud.png') }}" alt="Fundasalud Trujillo">
                <h1>Área Segura</h1>
                <p>Confirma tu identidad para acceder a contenido protegido</p>
                <div class="mt-4">
                    <span class="feature-badge"><i class="fa fa-shield-alt"></i> Protegido</span>
                    <span class="feature-badge"><i class="fa fa-user-shield"></i> Verificado</span>
                    <span class="feature-badge"><i class="fa fa-lock"></i> Seguro</span>
                </div>
            </div>
        </div>
        
        <!-- Lado Derecho - Formulario -->
        <div class="login-right">
            <div class="login-form-container">
                <div class="login-header">
                    <img src="{{ asset('storage/img/fundasalud.png') }}" alt="Fundasalud Trujillo" class="img-fluid d-xl-none d-lg-none .d-xl-block" style="max-width: 150px;">
                    <h2 class="mt-2">Confirmar Contraseña</h2>
                    <p>Por seguridad, confirma tu contraseña antes de continuar</p>
                </div>
                
                <div class="alert-info">
                    <i class="fa fa-info-circle"></i> Esta es un área protegida. Por favor confirma tu contraseña antes de continuar.
                </div>
                
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    
                    <!-- Password -->
                    <div class="form-group-custom">
                        <label for="password" class="form-label-custom">
                            Contraseña
                        </label>
                        <div class="input-wrapper">
                            <i class="fa fa-lock input-icon"></i>
                            <input 
                                id="password" 
                                type="password" 
                                class="form-control-custom @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                autofocus
                                placeholder="Ingresa tu contraseña">
                            
                            @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="btn-login">
                        <i class="fa fa-check-circle"></i> Confirmar Contraseña
                    </button>
                    
                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a class="forgot-password-link" href="{{ route('password.request') }}">
                                <i class="fa fa-key"></i> ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    @endif
                    
                    <!-- Security Badge -->
                    <div class="security-badge">
                        <i class="fa fa-shield-alt"></i>
                        <span>Conexión segura y cifrada</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
