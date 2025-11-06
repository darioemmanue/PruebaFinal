<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS externo -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">

  <style>
      body {
          background: url("{{ asset('fondo-login4.jpg') }}") no-repeat center center fixed;
          background-size: cover;
      }

      .error-text {
          margin-top: -6px;
          margin-bottom: 8px;
          font-size: 0.85rem;
      }

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

<form class="form" method="POST" action="{{ route('register') }}">
  @csrf

  <h3 class="text-center fw-bold mb-2">Crear cuenta</h3>

  {{-- Nombre --}}
  <input id="name" type="text" name="name"
      class="input @error('name') is-invalid @enderror"
      placeholder="Nombre completo"
      value="{{ old('name') }}" required autofocus>

  @error('name')
      <div class="invalid-feedback d-block error-text">
          {{ $message }}
      </div>
  @enderror

  {{-- Correo --}}
  <input id="email" type="email" name="email"
      class="input @error('email') is-invalid @enderror"
      placeholder="Correo electrónico"
      value="{{ old('email') }}" required>

  @error('email')
      <div class="invalid-feedback d-block error-text">
          {{ $message }}
      </div>
  @enderror

  {{-- Contraseña --}}
  <input id="password" type="password" name="password"
      class="input @error('password') is-invalid @enderror"
      placeholder="Contraseña" required>

  @error('password')
      <div class="invalid-feedback d-block error-text">
          {{ $message }}
      </div>
  @enderror

  {{-- Confirmación --}}
  <input id="password_confirmation" type="password" name="password_confirmation"
      class="input" placeholder="Confirmar contraseña" required>

  <button type="submit" class="btn btn-primary w-100 mt-2">Registrarse</button>

  <p class="text-center mt-2 mb-0">
    ¿Ya tienes cuenta?
    <a href="{{ route('login') }}">Iniciar sesión</a>
  </p>
</form>

</body>
</html>
