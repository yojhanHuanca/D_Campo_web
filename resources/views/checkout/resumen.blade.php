<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar Pedido - D'Campo</title>
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- ICONOS --}}
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
                    <a href="{{ route('checkout.pago') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        <span class="d-none d-sm-inline">Volver al pago</span>
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
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
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

                        {{-- Paso 2: Envío (Completado) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow-sm" style="width: 48px; height: 48px;">
                                <i class="bi bi-check-lg fs-4"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Envío</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Envío</small>
                        </div>

                        {{-- Paso 3: Pago (Completado) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow-sm" style="width: 48px; height: 48px;">
                                <i class="bi bi-check-lg fs-4"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Pago</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Pago</small>
                        </div>

                        {{-- Paso 4: Revisar (Activo) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow" style="width: 48px; height: 48px;">
                                <i class="bi bi-clipboard-check-fill fs-5"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Revisar</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Revisar</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- CONTENIDO PRINCIPAL --}}
<main class="container my-4 my-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">

            {{-- Encabezado --}}
            <div class="text-center mb-4 mb-md-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-clipboard-check-fill text-success display-6"></i>
                </div>
                <h3 class="fw-bold mb-2">Revisar Tu Pedido</h3>
                <p class="text-muted mb-0">Confirma que toda la información sea correcta antes de finalizar</p>
            </div>

            <div class="row g-4">

                {{-- COLUMNA IZQUIERDA: RESUMEN --}}
                <div class="col-12 col-lg-8">

                    {{-- Información de Envío --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-truck-front-fill text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Información de Envío</h5>
                                        <p class="text-muted mb-0 small">Detalles de entrega</p>
                                    </div>
                                </div>
                                <a href="{{ route('checkout.envio') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-pencil-square me-1"></i>Editar
                                </a>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="border-bottom pb-2 mb-2">
                                        <small class="text-muted d-block mb-1">Nombre completo</small>
                                        <p class="fw-bold mb-0">{{ $direccion->nombre_completo }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="border-bottom pb-2 mb-2">
                                        <small class="text-muted d-block mb-1">Dirección de entrega</small>
                                        <p class="fw-bold mb-0">{{ $direccion->direccion }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <small class="text-muted d-block mb-1">Teléfono</small>
                                        <p class="fw-bold mb-0">{{ $direccion->telefono }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="border-bottom pb-2 mb-2">
                                        <small class="text-muted d-block mb-1">Correo electrónico</small>
                                        <p class="fw-bold mb-0">{{ $direccion->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Método de Pago --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-credit-card-2-front-fill text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Método de Pago</h5>
                                        <p class="text-muted mb-0 small">Forma de pago seleccionada</p>
                                    </div>
                                </div>
                                <a href="{{ route('checkout.pago') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-pencil-square me-1"></i>Editar
                                </a>
                            </div>

                            {{-- Tarjeta --}}
                            @if($pago->metodo_pago === 'tarjeta')
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #f8f9fa;">
                                <div class="bg-white rounded-3 shadow-sm p-3">
                                    <i class="bi bi-credit-card-fill text-success fs-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Tarjeta de Crédito/Débito</h6>
                                    <p class="text-muted mb-1">Terminada en **** {{ $pago->numero_tarjeta ? substr($pago->numero_tarjeta, -4) : 'XXXX' }}</p>
                                    <small class="text-success fw-semibold">Pagado • {{ $pago->nombre_titular }}</small>
                                </div>
                            </div>
                            @endif

                            {{-- Yape --}}
                            @if($pago->metodo_pago === 'yape')
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #f8f9fa;">
                                <div class="bg-white rounded-3 shadow-sm p-3">
                                    <i class="bi bi-phone-fill fs-3" style="color: #6b2c91;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Yape</h6>
                                    <p class="text-muted mb-1">Pago móvil • Código: {{ $pago->codigo_operacion ?? 'N/A' }}</p>
                                    <small class="text-success fw-semibold">Pagado • 999 888 777</small>
                                </div>
                            </div>
                            @endif

                            {{-- Plin --}}
                            @if($pago->metodo_pago === 'plin')
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #f8f9fa;">
                                <div class="bg-white rounded-3 shadow-sm p-3">
                                    <i class="bi bi-phone-fill fs-3 text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Plin</h6>
                                    <p class="text-muted mb-1">Pago móvil • Código: {{ $pago->codigo_operacion ?? 'N/A' }}</p>
                                    <small class="text-success fw-semibold">Pagado • 999 888 777</small>
                                </div>
                            </div>
                            @endif

                            {{-- Transferencia --}}
                            @if($pago->metodo_pago === 'transferencia')
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #f8f9fa;">
                                <div class="bg-white rounded-3 shadow-sm p-3">
                                    <i class="bi bi-bank2 fs-3 text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Transferencia Bancaria</h6>
                                    <p class="text-muted mb-1">BCP • Comprobante verificado</p>
                                    <small class="text-success fw-semibold">Pagado • {{ $pago->nombre_titular ?? 'Cliente' }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Productos --}}
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-bag-check-fill text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Productos</h5>
                                        <p class="text-muted mb-0 small">{{ count($items) }} artículos en tu pedido</p>
                                    </div>
                                </div>
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">
                                    <i class="bi bi-pencil-square me-1"></i>Editar
                                </a>
                            </div>

                            @foreach($items as $item)
                            <div class="d-flex align-items-center gap-3 mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                {{-- Imagen --}}
                                <div class="flex-shrink-0">
                                    @if($item->producto->imagen)
                                    <img src="{{ asset('storage/'.$item->producto->imagen) }}"
                                         class="rounded-3 object-fit-cover"
                                         style="width: 70px; height: 70px;"
                                         alt="{{ $item->producto->nombre }}">
                                    @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="bi bi-image text-muted fs-4"></i>
                                    </div>
                                    @endif
                                </div>

                                {{-- Información --}}
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $item->producto->nombre }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <small class="text-muted">
                                            <i class="bi bi-tag me-1"></i>S/ {{ number_format($item->producto->precio, 2) }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="bi bi-x-lg me-1"></i>{{ $item->cantidad }} unidades
                                        </small>
                                    </div>
                                </div>

                                {{-- Total --}}
                                <div class="text-end">
                                    <h6 class="fw-bold text-success mb-0">
                                        S/ {{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                    </h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- COLUMNA DERECHA: RESUMEN FINAL --}}
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm position-sticky" style="top: 100px;">
                        <div class="card-body p-3 p-md-4">

                            <h5 class="fw-bold mb-4 pb-3 border-bottom">
                                <i class="bi bi-receipt-cutoff text-success me-2"></i>
                                Resumen Final
                            </h5>

                            {{-- Desglose --}}
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Subtotal ({{ count($items) }} items)</span>
                                    <span class="fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">IGV (18%)</span>
                                    <span class="fw-semibold">S/ {{ number_format($igv, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Costo de envío</span>
                                    <span class="fw-semibold">S/ {{ number_format($envio, 2) }}</span>
                                </div>

                                @if($descuento > 0)
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="text-muted">Descuento</span>
                                        <small class="d-block text-success fw-semibold">{{ $codigo_cupon }}</small>
                                    </div>
                                    <span class="fw-bold text-success">- S/ {{ number_format($descuento, 2) }}</span>
                                </div>
                                @endif
                            </div>

                            <hr class="my-4">

                            {{-- Total --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold fs-5">Total a Pagar</span>
                                <span class="fw-bold fs-3 text-success">
                                    S/ {{ number_format($total, 2) }}
                                </span>
                            </div>

                            {{-- Alerta de envío gratis --}}
                            @if($subtotal >= 150)
                            <div class="alert alert-success border-0 mb-4 py-2 px-3">
                                <small class="d-flex align-items-center">
                                    <i class="bi bi-gift-fill me-2"></i>
                                    ¡Felicidades! Tienes envío gratis
                                </small>
                            </div>
                            @endif

                            {{-- Botón Principal --}}
                            <a href="{{ route('checkout.confirmacion') }}" 
                               class="btn btn-success btn-lg w-100 rounded-pill shadow-sm mb-3 d-flex align-items-center justify-content-center">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Confirmar Pedido
                            </a>

                            <a href="{{ route('checkout.pago') }}" 
                               class="btn btn-outline-secondary w-100 rounded-pill">
                                <i class="bi bi-arrow-left-circle me-2"></i>
                                Volver al Pago
                            </a>

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
                                            <i class="bi bi-truck text-success fs-5 me-3"></i>
                                            <div>
                                                <small class="fw-semibold d-block">Envío Rápido</small>
                                                <small class="text-muted">24-48 horas</small>
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
