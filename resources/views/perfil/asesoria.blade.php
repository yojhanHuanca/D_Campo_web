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
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-headset text-primary fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Asesoría y Soporte</h4>
                        <p class="text-muted small mb-0">Estamos aquí para ayudarte con cualquier consulta o problema</p>
                    </div>
                </div>
            </div>

            {{-- TARJETAS DE CONTACTO RÁPIDO --}}
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                        <div class="card-body text-center p-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-telephone-fill text-primary fs-3"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Teléfono</h6>
                            <small class="text-muted d-block mb-2">Lun - Sáb: 9AM - 6PM</small>
                            <a href="tel:+51987654321" class="text-decoration-none">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">+51 987 654 321</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                        <div class="card-body text-center p-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-whatsapp text-success fs-3"></i>
                            </div>
                            <h6 class="fw-bold mb-1">WhatsApp</h6>
                            <small class="text-muted d-block mb-2">Respuesta inmediata</small>
                            <a href="https://wa.me/51987654321" target="_blank" class="btn btn-success btn-sm rounded-pill px-3">
                                <i class="bi bi-chat-dots me-1"></i>Iniciar chat
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                        <div class="card-body text-center p-3">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                <i class="bi bi-envelope-fill text-danger fs-3"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <small class="text-muted d-block mb-2">Respuesta en 24h</small>
                            <a href="mailto:soporte@dcampo.pe" class="text-decoration-none">
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">soporte@dcampo.pe</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULARIO DE CONSULTA --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                <div class="bg-success" style="height: 3px;"></div>
                
                <div class="card-body p-3">

                    <div class="mb-3">
                        <h6 class="fw-bold mb-1 d-flex align-items-center gap-2">
                            <i class="bi bi-chat-left-text text-success"></i>
                            Enviar consulta
                        </h6>
                        <p class="text-muted small mb-0">
                            Completa el formulario y te responderemos lo antes posible
                        </p>
                    </div>

                    {{-- NOTIFICACIÓN DE ÉXITO --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <span class="small">{{ session('success') }}</span>
                            </div>
                            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3" role="alert">
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('perfil.asesoria.enviar') }}" method="POST" id="consultaForm">
                        @csrf

                        {{-- CATEGORÍA --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-2">
                                <i class="bi bi-tag text-success me-1"></i>
                                Categoría de consulta
                            </label>

                            <div class="row g-2">
                                @php
                                    $categorias = [
                                        'general'  => ['label' => 'General', 'icon' => 'chat-square-text'],
                                        'producto' => ['label' => 'Producto', 'icon' => 'box-seam'],
                                        'pedido'   => ['label' => 'Pedido', 'icon' => 'bag-check'],
                                        'tecnico'  => ['label' => 'Técnico', 'icon' => 'gear'],
                                    ];
                                @endphp

                                @foreach ($categorias as $value => $cat)
                                    <div class="col-6 col-md-3">
                                        <input type="radio" 
                                               class="btn-check" 
                                               name="categoria" 
                                               id="cat_{{ $value }}"
                                               value="{{ $value }}"
                                               {{ old('categoria', 'general') === $value ? 'checked' : '' }}>
                                        <label class="btn btn-outline-success w-100 rounded-3" for="cat_{{ $value }}">
                                            <i class="bi bi-{{ $cat['icon'] }} d-block mb-1"></i>
                                            <small>{{ $cat['label'] }}</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- ASUNTO --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-pencil text-success me-1"></i>
                                Asunto
                            </label>
                            <input type="text"
                                   name="asunto"
                                   class="form-control rounded-3"
                                   placeholder="Ej: Consulta sobre aceite facial"
                                   value="{{ old('asunto') }}"
                                   required>
                        </div>

                        {{-- MENSAJE --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-chat-left-dots text-success me-1"></i>
                                Mensaje
                            </label>
                            <textarea name="mensaje"
                                      id="mensaje"
                                      rows="4"
                                      class="form-control rounded-3"
                                      placeholder="Describe tu consulta o problema con el mayor detalle posible..."
                                      maxlength="500"
                                      required>{{ old('mensaje') }}</textarea>
                            <small class="text-muted" id="charCount">0/500 caracteres</small>
                        </div>

                        {{-- EMAIL CONTACTO --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold mb-1">
                                <i class="bi bi-envelope text-success me-1"></i>
                                Tu información de contacto
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control rounded-3"
                                   value="{{ old('email', $user->email) }}"
                                   readonly
                                   style="background-color: #f8f9fa;">
                        </div>

                        {{-- BOTÓN ENVIAR --}}
                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-semibold" id="submitBtn">
                            <i class="bi bi-send me-2"></i>
                            Enviar mensaje
                        </button>
                    </form>
                </div>
            </div>

            {{-- PREGUNTAS FRECUENTES --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-patch-question text-success"></i>
                        Preguntas Frecuentes
                    </h6>

                    <div class="accordion accordion-flush" id="faqAccordion">
                        
                        {{-- Pregunta 1 --}}
                        <div class="accordion-item border-0 mb-2 rounded-3" style="background: #f8f9fa;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold small rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="bi bi-truck text-success me-2"></i>
                                    ¿Cuál es el tiempo de entrega?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Los pedidos dentro de Lima llegan en 24-48 horas. Para provincias, entre 3-5 días hábiles.
                                </div>
                            </div>
                        </div>

                        {{-- Pregunta 2 --}}
                        <div class="accordion-item border-0 mb-2 rounded-3" style="background: #f8f9fa;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold small rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="bi bi-leaf text-success me-2"></i>
                                    ¿Los productos son 100% naturales?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Sí, todos nuestros productos están hechos con ingredientes naturales certificados y sin químicos dañinos.
                                </div>
                            </div>
                        </div>

                        {{-- Pregunta 3 --}}
                        <div class="accordion-item border-0 mb-2 rounded-3" style="background: #f8f9fa;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold small rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="bi bi-arrow-counterclockwise text-success me-2"></i>
                                    ¿Puedo devolver un producto?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Aceptamos devoluciones dentro de los 30 días si el producto no ha sido abierto.
                                </div>
                            </div>
                        </div>

                        {{-- Pregunta 4 --}}
                        <div class="accordion-item border-0 rounded-3" style="background: #f8f9fa;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold small rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="bi bi-tag text-success me-2"></i>
                                    ¿Cómo uso los cupones de descuento?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Ingresa el código del cupón en el checkout antes de realizar el pago.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HORARIO DE ATENCIÓN --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="fw-bold mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-clock-history text-success"></i>
                                Horario de Atención
                            </h6>
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-1 d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <span>Lunes a Viernes: 9:00 AM - 6:00 PM</span>
                                </li>
                                <li class="mb-1 d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                    <span>Sábados: 9:00 AM - 1:00 PM</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                    <span>Domingos: Cerrado</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="bi bi-heart-fill text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER MENSAJE --}}
            <div class="text-center mt-3 py-2">
                <p class="text-muted small mb-0">
                    <i class="bi bi-shield-check text-success me-1"></i>
                    <strong>Estamos aquí para ayudarte</strong>
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
.hover-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.btn-check:checked + .btn-outline-success {
    background-color: #198754;
    color: white;
}

.accordion-button:not(.collapsed) {
    background-color: #198754;
    color: white;
}

.accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}

.accordion-button {
    background-color: transparent;
    padding: 0.75rem 1rem;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.alert {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- SCRIPTS --}}
<script>
// Contador de caracteres
document.getElementById('mensaje').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('charCount').textContent = count + '/500 caracteres';
});

// Manejar envío del formulario
document.getElementById('consultaForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';
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