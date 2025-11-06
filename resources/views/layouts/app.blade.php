<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karting App</title>

    <link rel="icon" type="image/png" href="{{ asset('go-kart.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ✅ Fondo general */
        body {
            background: url("{{ asset('fondo-login4.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            color: #F1F5F9;
        }

        /* ✅ NAVBAR vidrio */
        .navbar {
            position: fixed;          /* ✅ SIEMPRE fijada arriba */
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;            /* ✅ Para que quede encima de todo */

            background: rgba(255, 255, 255, 0.08) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.20);
            box-shadow: 0 8px 25px rgba(0,0,0,0.45);

            
        }

        /* Logo */
        .navbar-brand {
            font-weight: 700;
            color: #F8FAFC !important;
            font-size: 1.6rem;
            text-shadow: 0 3px 6px rgba(0,0,0,0.45);
        }

        /* ✅ Contenedor principal vidrio */
        main.container {
            
         padding: 0px;
         margin-top: 6rem;

        }

        /* ✅ NOTIFICACIÓN glass + animación */
        .toast-glass {
            position: fixed;
            top: 90px;
            right: 25px;
            z-index: 3000;

            padding: 16px 20px;
            min-width: 280px;

            border-radius: 18px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(14px);

            border: 1px solid rgba(255,255,255,0.25);
            box-shadow: 0 10px 35px rgba(0,0,0,0.55);

            display: flex;
            align-items: center;
            gap: 12px;

            font-size: 1rem;

            animation: toastIn 0.55s ease forwards;
        }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(120%); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .toast-glass.toast-hide {
            animation: toastOut 0.55s ease forwards;
        }

        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0); }
            to   { opacity: 0; transform: translateX(120%); }
        }
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg px-3">
    <div class="container">
        <a class="navbar-brand ms-0" href="{{ route('kartings.index') }}">Karting App</a>
    </div>
</nav>


{{-- ✅ NOTIFICACIÓN GLOBAL --}}
@if(session('success'))
    <div id="toast" class="toast-glass">
        <i class="bi bi-check-circle-fill text-success fs-4"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif


<main class="container">
    @yield('content')
</main>


<script>
    // ✅ Ocultar toast automáticamente
    setTimeout(() => {
        const t = document.getElementById("toast");
        if (t) t.classList.add("toast-hide");
    }, 3000);
</script>

</body>
</html>
