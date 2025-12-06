<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envío - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

{{-- HEADER --}}
<header class="bg-white shadow-sm position-sticky top-0" style="z-index: 1030;">
    
    {{-- Barra Superior --}}
    <div class="border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-6 col-md-auto">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        <span class="d-none d-sm-inline">Volver al carrito</span>
                        <span class="d-inline d-sm-none">Atrás</span>
                    </a>
                </div>

                <div class="col-6 col-md text-end">
                    <div class="d-inline-flex align-items-center gap-2">
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                            <span class="fw-bold text-white fs-5">D</span>
                        </div>
                        <span class="fw-bold text-success d-none d-sm-inline">D'CAMPO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Barra de Progreso --}}
    <div class="bg-white py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="d-flex justify-content-between align-items-center position-relative">

                        {{-- Línea de progreso --}}
                        <div class="position-absolute top-50 start-0 end-0 translate-middle-y">
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 33%"></div>
                            </div>
                        </div>

                        {{-- Paso 1: Carrito (Completado) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow-sm" style="width: 48px; height: 48px;">
                                <i class="bi bi-check-lg fs-4"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Carrito</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Carrito</small>
                        </div>

                        {{-- Paso 2: Envío (Activo) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow" style="width: 48px; height: 48px;">
                                <i class="bi bi-truck-front-fill fs-5"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Envío</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Envío</small>
                        </div>

                        {{-- Paso 3: Pago --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-white border border-2 border-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 48px; height: 48px;">
                                <i class="bi bi-credit-card fs-5 text-secondary"></i>
                            </div>
                            <small class="text-secondary d-none d-md-block">Pago</small>
                            <small class="text-secondary d-block d-md-none" style="font-size: 0.7rem;">Pago</small>
                        </div>

                        {{-- Paso 4: Confirmar --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-white border border-2 border-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 48px; height: 48px;">
                                <i class="bi bi-check-circle fs-5 text-secondary"></i>
                            </div>
                            <small class="text-secondary d-none d-md-block">Revisar</small>
                            <small class="text-secondary d-block d-md-none" style="font-size: 0.7rem;">Revisar</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- CONTENIDO PRINCIPAL --}}
<main class="container my-4 my-md-5">
    <div class="row g-4">
        
        {{-- COLUMNA IZQUIERDA: FORMULARIO --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4 p-lg-5">

                    {{-- Encabezado --}}
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-truck-front-fill text-success fs-4"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Información de Envío</h4>
                                <p class="text-muted mb-0 small">Completa los datos para recibir tu pedido</p>
                            </div>
                        </div>
                    </div>

                    {{-- Mensajes de Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Formulario --}}
                    <form action="{{ route('checkout.envio.guardar') }}" method="POST">
                        @csrf

                        {{-- Sección: Datos Personales --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="bi bi-person-badge me-2"></i>
                                Datos Personales
                            </h6>

                            <div class="row g-3">
                                {{-- Nombre completo --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold mb-2">
                                        Nombre completo
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-person text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               name="nombre_completo"
                                               value="{{ old('nombre_completo', $direccion->nombre_completo ?? auth()->user()->name) }}"
                                               class="form-control border-start-0"
                                               placeholder="Ej: Juan Pérez García"
                                               required>
                                    </div>
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Teléfono de contacto
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-telephone text-muted"></i>
                                        </span>
                                        <input type="tel" 
                                               name="telefono"
                                               value="{{ old('telefono', $direccion->telefono ?? '') }}"
                                               class="form-control border-start-0"
                                               placeholder="999 999 999"
                                               required>
                                    </div>
                                    <small class="text-muted">Para coordinar la entrega</small>
                                </div>

                                {{-- Email --}}
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Correo electrónico
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               name="email"
                                               value="{{ old('email', $direccion->email ?? auth()->user()->email) }}"
                                               class="form-control border-start-0"
                                               placeholder="ejemplo@correo.com">
                                    </div>
                                    <small class="text-muted">Para enviar la confirmación</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Sección: Dirección de Entrega --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                Dirección de Entrega
                            </h6>

                            <div class="row g-3">
                                {{-- Dirección completa --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold mb-2">
                                        Dirección completa
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-house-door text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               name="direccion"
                                               value="{{ old('direccion', $direccion->direccion ?? '') }}"
                                               class="form-control border-start-0"
                                               placeholder="Av. Principal 123, Dpto. 456, Distrito, Ciudad"
                                               required>
                                    </div>
                                    <small class="text-muted">Incluye calle, número, departamento, distrito y ciudad</small>
                                </div>
                            </div>
                        </div>

                        {{-- Nota informativa --}}
                        <div class="alert alert-info border-0 d-flex align-items-start">
                            <i class="bi bi-info-circle-fill text-info fs-5 me-3 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Información importante</strong>
                                <small>Asegúrate de que todos los datos sean correctos. El repartidor se comunicará contigo al número proporcionado para coordinar la entrega.</small>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="d-grid gap-3 mt-4">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm d-flex align-items-center justify-content-center">
                                Continuar al Pago
                                <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                            </button>
                            
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary rounded-pill d-flex align-items-center justify-content-center">
                                <i class="bi bi-arrow-left-circle me-2"></i>
                                Volver al Carrito
                            </a>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Beneficios de envío --}}
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-truck text-success me-2"></i>
                        Beneficios de Envío
                    </h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-clock-fill text-success fs-5 me-2"></i>
                                <div>
                                    <small class="fw-semibold d-block">Entrega Rápida</small>
                                    <small class="text-muted">En 24-48 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-box-seam-fill text-success fs-5 me-2"></i>
                                <div>
                                    <small class="fw-semibold d-block">Empaque Seguro</small>
                                    <small class="text-muted">Productos protegidos</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-geo-alt-fill text-success fs-5 me-2"></i>
                                <div>
                                    <small class="fw-semibold d-block">Seguimiento</small>
                                    <small class="text-muted">Rastrea tu pedido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- COLUMNA DERECHA: RESUMEN --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm position-sticky" style="top: 100px;">
                <div class="card-body p-3 p-md-4">

                    <h5 class="fw-bold mb-4 pb-3 border-bottom">
                        <i class="bi bi-receipt-cutoff text-success me-2"></i>
                        Resumen del Pedido
                    </h5>

                    {{-- Desglose de precios --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <small class="text-muted d-block">Subtotal</small>
                                <small class="text-muted">Productos</small>
                            </div>
                            <span class="fw-bold">S/ {{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <small class="text-muted d-block">IGV</small>
                                <small class="text-muted">18% incluido</small>
                            </div>
                            <span class="fw-bold">S/ {{ number_format($igv, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <small class="text-muted d-block">Envío</small>
                                <small class="text-muted">Delivery estándar</small>
                            </div>
                            <span class="fw-bold">S/ {{ number_format($envio, 2) }}</span>
                        </div>
                    </div>

                    {{-- Promoción de envío gratis --}}
                    <div class="alert alert-success border-0 mb-4 py-2 px-3">
                        <small class="d-flex align-items-center">
                            <i class="bi bi-gift-fill me-2"></i>
                            Envío gratis en compras mayores a S/ 150
                        </small>
                    </div>

                    {{-- Total --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-6">Total a Pagar</span>
                            <span class="fw-bold fs-3 text-success">S/ {{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    {{-- Métodos de pago disponibles --}}
                    <div class="text-center pt-3 border-top">
                        <small class="text-muted d-block mb-3 fw-semibold">Métodos de pago disponibles</small>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-credit-card-fill text-primary me-1"></i>Visa
                            </span>
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-credit-card-fill text-warning me-1"></i>Mastercard
                            </span>
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-phone-fill text-info me-1"></i>Yape
                            </span>
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-wallet2 text-success me-1"></i>Plin
                            </span>
                        </div>
                    </div>

                    {{-- Garantías --}}
                    <div class="mt-4 pt-3 border-top">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item bg-transparent border-0 px-0 py-2">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-shield-check text-success fs-5 me-3"></i>
                                    <div>
                                        <small class="fw-semibold d-block">Compra Segura</small>
                                        <small class="text-muted">Pago protegido</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent border-0 px-0 py-2">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-arrow-repeat text-success fs-5 me-3"></i>
                                    <div>
                                        <small class="fw-semibold d-block">Devolución Gratis</small>
                                        <small class="text-muted">Hasta 30 días</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent border-0 px-0 py-2">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-headset text-success fs-5 me-3"></i>
                                    <div>
                                        <small class="fw-semibold d-block">Soporte 24/7</small>
                                        <small class="text-muted">Siempre disponibles</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>

{{-- FOOTER --}}
<footer class="bg-white border-top mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <small class="text-muted">
                    <i class="bi bi-lock-fill me-1"></i>
                    Conexión segura - © 2024 D'Campo - Productos frescos del campo
                </small>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>