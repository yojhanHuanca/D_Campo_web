<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - D'Campo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5f5f5;
            min-height: 100vh;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-box {
            max-width: 400px;
            width: 100%;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .input-custom {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 12px;
            transition: all 0.3s ease;
        }
        .input-custom:focus {
            background: #fff;
            border-color: #79a98c;
            box-shadow: 0 0 0 0.2rem rgba(121, 169, 140, 0.15);
        }
        .btn-login {
            background: #79a98c;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: #6a9478;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(121, 169, 140, 0.3);
        }
        .btn-back {
            background: transparent;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #f8f9fa;
            border-color: #dee2e6;
        }
        
        /* Loading Overlay */
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column;
        }
        #loadingOverlay.show {
            display: flex;
        }
        .spinner-custom {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #79a98c;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #79a98c;
        }
    </style>
</head>

<body>

<!-- Loading Overlay -->
<div id="loadingOverlay">
    <div class="spinner-custom mb-3"></div>
    <h5 class="fw-bold text-dark">Iniciando sesión...</h5>
    <p class="text-muted">Por favor espera un momento</p>
</div>

<div class="login-container">
    <div class="login-box p-4">

        <!-- Botón regresar -->
        <a href="{{ route('home') }}" class="btn btn-back text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i>Regresar
        </a>

        <!-- Logo y título -->
        <div class="text-center mb-3">
            <div class="logo-text mb-2">
                <i class="bi bi-shop"></i> D'Campo
            </div>
            <h4 class="fw-bold mb-1">Bienvenido de nuevo</h4>
            <p class="text-muted small mb-0">Inicia sesión para continuar</p>
        </div>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm py-2 d-flex align-items-start" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div class="flex-grow-1 small">
                    <strong>Error al iniciar sesión</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Mensaje éxito --}}
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm py-2 d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div class="small">{{ session('success') }}</div>
            </div>
        @endif

        {{-- FORMULARIO LOGIN --}}
        <form method="POST" action="{{ route('auth.login') }}" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold small">
                    <i class="bi bi-envelope me-1"></i>Correo electrónico
                </label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       class="form-control input-custom" 
                       placeholder="tu@email.com"
                       required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label fw-semibold small">
                    <i class="bi bi-lock me-1"></i>Contraseña
                </label>
                <div class="position-relative">
                    <input type="password" 
                           name="password" 
                           id="passwordInput"
                           class="form-control input-custom" 
                           placeholder="••••••••"
                           required>
                    <button type="button" 
                            class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted p-0 pe-2"
                            onclick="togglePassword()"
                            style="text-decoration: none;">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Botón Submit -->
            <button type="submit" class="btn btn-login text-white w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>

        <!-- Registro -->
        <div class="text-center">
            <p class="mb-0 text-muted small">
                ¿No tienes cuenta? 
                <a href="{{ route('auth.register.form') }}" class="text-decoration-none fw-semibold" style="color: #79a98c;">
                    Regístrate aquí
                </a>
            </p>
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Mostrar loading al enviar formulario
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const overlay = document.getElementById('loadingOverlay');
    overlay.classList.add('show');
});

// Función para mostrar/ocultar contraseña
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

// Auto-ocultar alertas después de 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

</body>
</html>
