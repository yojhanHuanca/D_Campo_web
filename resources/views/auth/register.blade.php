<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta - D'Campo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .register-box {
            width: 380px;
            border-radius: 18px;
            background: #fff;
        }
        .input-custom {
            background: #faf7f2 !important;
            border-radius: 10px !important;
            padding: 12px !important;
        }
        .btn-green {
            background: #79a98c;
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-green:hover {
            background: #6b947b;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="register-box shadow-sm p-4">

        <!-- Botón regresar -->
        <a href="{{ route('home') }}" class="text-decoration-none text-muted mb-3 d-inline-block">
    ← Regresar
        </a>

        <h3 class="text-center fw-bold">Crear Cuenta</h3>
        <p class="text-center text-muted mb-4">
            Regístrate para disfrutar de todos los beneficios
        </p>

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

        {{-- FORMULARIO DE REGISTRO --}}
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <label class="fw-medium">Nombre completo</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="form-control input-custom mb-3" required>

            <label class="fw-medium">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="form-control input-custom mb-3" required>

            <label class="fw-medium">Contraseña</label>
            <input type="password" name="password"
                   class="form-control input-custom mb-2" required>

            <small class="text-muted">Mínimo 6 caracteres</small>

            <label class="fw-medium mt-3">Confirmar contraseña</label>
            <input type="password" name="password_confirmation"
                   class="form-control input-custom mb-4" required>

            <button type="submit" class="btn btn-green w-100 py-2">
                Crear Cuenta
            </button>
        </form>

        <p class="text-center mt-3">
            ¿Ya tienes cuenta?
            <a href="{{ route('auth.login.form') }}" class="text-success fw-semibold">
                Inicia sesión aquí
            </a>
        </p>

    </div>
</div>

</body>
</html>
