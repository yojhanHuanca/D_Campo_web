<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - D'Campo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .login-box {
            width: 380px;
            border-radius: 18px;
            background: #fff;
        }
        .input-custom {
            background: #faf7f2 !important;
            border-radius: 10px !important;
            padding: 12px !important;
        }
        /* Loading */
        #loadingOverlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
    </style>
</head>

<body>



<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-box shadow-sm p-4">

        <!-- Botón regresar -->
        <a href="{{ route('home') }}" class="text-decoration-none text-muted mb-3 d-inline-block">
    ← Regresar
        </a>

        <h3 class="text-center fw-bold">Bienvenido de nuevo</h3>
        <p class="text-center text-muted mb-4">Inicia sesión para acceder a tu cuenta</p>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger py-2">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Mensaje éxito --}}
        @if (session('success'))
            <div class="alert alert-success py-2">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORMULARIO LOGIN --}}
        <form method="POST" action="{{ route('auth.login') }}" id="loginForm">
            @csrf

            <label class="fw-medium">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control input-custom" required>

            <label class="fw-medium mt-3">Contraseña</label>
            <input type="password" name="password" class="form-control input-custom" required>

            <button type="submit" class="btn w-100 text-white mt-4 py-2"
                style="background:#79a98c; border-radius:10px;">
                Iniciar Sesión
            </button>
        </form>

        <p class="text-center mt-3">
            ¿No tienes cuenta?
            <a href="{{ route('auth.register.form') }}" class="text-success fw-semibold">Regístrate aquí</a>
        </p>

    </div>
</div>

<!-- Script para activar la animación de carga -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('loadingOverlay');

    if (overlay) {
        overlay.addEventListener('click', function() {
            window.location.href = "{{ route('home') }}";
        });
    }
});
</script>

</body>
</html>

