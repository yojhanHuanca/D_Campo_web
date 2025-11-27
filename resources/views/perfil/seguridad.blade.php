@extends('layouts.perfil')

@section('content')
<div class="container py-4">
    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            @include('perfil.sidebar')
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="col-md-9">

            {{-- ENCABEZADO --}}
            <div class="bg-white rounded-4 shadow-sm p-3 mb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-shield-lock-fill text-warning fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Seguridad</h4>
                        <p class="text-muted small mb-0">Protege tu cuenta y datos personales</p>
                    </div>
                </div>
            </div>

            {{-- NOTIFICACIÓN DE ÉXITO (inicialmente oculta) --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>
                        <strong class="small">¡Contraseña actualizada!</strong>
                        <p class="mb-0 small">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- NOTIFICACIÓN DE ERROR --}}
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <div>
                        <strong class="small">Error al cambiar contraseña</strong>
                        <p class="mb-0 small">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- CARD PRINCIPAL --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                {{-- Barra decorativa --}}
                <div class="bg-warning" style="height: 3px;"></div>

                <div class="card-body p-3">

                    {{-- Título --}}
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">
                            <i class="bi bi-key-fill text-warning me-2"></i>
                            Cambiar Contraseña
                        </h6>
                        <p class="text-muted small mb-0">
                            Mantén tu cuenta segura con una contraseña fuerte
                        </p>
                    </div>

                    {{-- FORMULARIO --}}
                    <form action="{{ route('perfil.seguridad.cambiar') }}" method="POST" id="passwordForm">
                        @csrf

                        {{-- CONTRASEÑA ACTUAL --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-lock text-warning me-1"></i>
                                Contraseña actual
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       name="password_actual"
                                       id="currentPassword"
                                       class="form-control rounded-3 @error('password_actual') is-invalid @enderror" 
                                       placeholder="Ingresa tu contraseña actual"
                                       required>
                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y p-0 pe-2" onclick="togglePassword('currentPassword', this)" style="z-index: 10;">
                                    <i class="bi bi-eye text-muted"></i>
                                </button>
                            </div>
                            @error('password_actual')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NUEVA CONTRASEÑA --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-lock text-warning me-1"></i>
                                Nueva contraseña
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       name="nueva_password"
                                       id="newPassword"
                                       class="form-control rounded-3 @error('nueva_password') is-invalid @enderror" 
                                       placeholder="Crea una contraseña segura"
                                       required>
                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y p-0 pe-2" onclick="togglePassword('newPassword', this)" style="z-index: 10;">
                                    <i class="bi bi-eye text-muted"></i>
                                </button>
                            </div>
                            <small class="text-muted d-flex align-items-center gap-1 mt-1">
                                <i class="bi bi-info-circle"></i>
                                Mínimo 6 caracteres para mayor seguridad
                            </small>
                            @error('nueva_password')
                                <div class="text-danger small mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- CONFIRMAR CONTRASEÑA --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-lock-check text-warning me-1"></i>
                                Confirmar nueva contraseña
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       name="nueva_password_confirmation"
                                       id="confirmPassword"
                                       class="form-control rounded-3" 
                                       placeholder="Confirma tu nueva contraseña"
                                       required>
                                <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y p-0 pe-2" onclick="togglePassword('confirmPassword', this)" style="z-index: 10;">
                                    <i class="bi bi-eye text-muted"></i>
                                </button>
                            </div>
                        </div>

                        {{-- BOTÓN GUARDAR --}}
                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-semibold" id="submitBtn">
                            <i class="bi bi-shield-check me-2"></i>
                            Cambiar Contraseña
                        </button>

                    </form>

                </div>
            </div>

            {{-- CONSEJOS DE SEGURIDAD --}}
            <div class="card border-0 rounded-3 mt-3" style="background: linear-gradient(135deg, #fff3cd 0%, #fffbef 100%);">
                <div class="card-body p-3">
                    <h6 class="fw-bold small mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-lightbulb-fill text-warning"></i>
                        Consejos para una contraseña segura
                    </h6>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 0.8rem; margin-top: 2px;"></i>
                                <small class="text-muted" style="font-size: 0.8rem;">Usa al menos 8 caracteres</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 0.8rem; margin-top: 2px;"></i>
                                <small class="text-muted" style="font-size: 0.8rem;">Combina letras, números y símbolos</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 0.8rem; margin-top: 2px;"></i>
                                <small class="text-muted" style="font-size: 0.8rem;">Evita información personal</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 0.8rem; margin-top: 2px;"></i>
                                <small class="text-muted" style="font-size: 0.8rem;">No reutilices contraseñas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER MENSAJE --}}
            <div class="text-center mt-3 py-2">
                <p class="text-muted small mb-0">
                    <i class="bi bi-shield-check text-success me-1"></i>
                    <strong>Tu seguridad es nuestra prioridad</strong>
                    <i class="bi bi-shield-check text-success ms-1"></i>
                </p>
                <p class="text-muted small mb-0" style="font-size: 0.8rem;">
                    Gracias por confiar en D'Campo • Productos 100% naturales
                </p>
            </div>

        </div>

    </div>
</div>

{{-- ESTILOS --}}
<style>
.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.15);
}

.btn-link {
    text-decoration: none;
}

.btn-link:hover i {
    color: #ffc107 !important;
}

.alert {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- SCRIPTS --}}
<script>
// Toggle mostrar/ocultar contraseña
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Manejar envío del formulario
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Cambiando...';
});

// Auto-cerrar alertas después de 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection