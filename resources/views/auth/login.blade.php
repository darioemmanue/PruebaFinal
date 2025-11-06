<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS propio -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <style>
        /* Fondo */
        body {
            background: url("{{ asset('fondo-login4.jpg') }}") no-repeat center center fixed;
            background-size: cover;
        }

        /* Ajuste fino de errores para que queden bien alineados */
        .error-text {
            margin-top: -6px;
            margin-bottom: 8px;
            font-size: 0.875rem;
        }

        /* Inputs uniformes */
        .input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <h3 class="text-center fw-bold mb-2">Iniciar Sesión</h3>

        @if (session('status'))
            <div class="alert alert-success py-1 text-center">{{ session('status') }}</div>
        @endif

        {{-- EMAIL --}}
        <input id="email" type="email" name="email"
               class="input @error('email') is-invalid @enderror"
               placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>

        @error('email')
            <div class="invalid-feedback d-block error-text">
                {{ $message }}
            </div>
        @enderror

        {{-- CONTRASEÑA --}}
        <input id="password" type="password" name="password"
               class="input @error('password') is-invalid @enderror"
               placeholder="Contraseña" required>

        @error('password')
            <div class="invalid-feedback d-block error-text">
                {{ $message }}
            </div>
        @enderror

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Recordarme</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Acceder</button>

        <p class="text-center mt-2 mb-0">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </p>

    </form>

</body>
</html>
