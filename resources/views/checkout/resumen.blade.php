<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisar Pedido - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f7f7f7; }
    </style>
</head>
<body>

{{-- HEADER FIJO --}}
<div class="position-sticky top-0 bg-white shadow-sm" style="z-index: 1000;">
    
    {{-- Navegación --}}
    <div class="border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="{{ route('checkout.pago') }}" class="btn btn-link text-decoration-none text-dark">
                        <i class="bi bi-arrow-left me-2"></i>Atrás
                    </a>
                </div>
                <div class="col text-end">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 40px; height: 40px;">
                            <span class="fw-bold text-success">D</span>
                        </div>
                        <span class="fw-bold">D'CAMPO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="border-bottom py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center position-relative">
                
                <div class="position-absolute top-50 start-0 end-0 border-top border-2 border-success"></div>

                {{-- Carrito - Completado --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg fs-4"></i>
                    </div>
                    <small class="text-success fw-semibold">Carrito</small>
                </div>

                {{-- Envío - Completado --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg fs-4"></i>
                    </div>
                    <small class="text-success fw-semibold">Envío</small>
                </div>

                {{-- Pago - Completado --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg fs-4"></i>
                    </div>
                    <small class="text-success fw-semibold">Pago</small>
                </div>

                {{-- Revisar - Activo --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-clipboard-check fs-5"></i>
                    </div>
                    <small class="text-success fw-semibold">Revisar</small>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CONTENIDO --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Título --}}
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-clipboard-check text-success fs-1"></i>
                </div>
                <h3 class="fw-bold mb-2">Revisar Pedido</h3>
                <p class="text-muted">Confirma que toda la información sea correcta</p>
            </div>

            {{-- Información de Envío --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-truck text-success me-2"></i>
                            Información de Envío
                        </h6>
                        <a href="{{ route('checkout.envio') }}" class="btn btn-sm btn-outline-success rounded-pill">
                            Editar
                        </a>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-12">
                            <small class="text-muted">Nombre:</small>
                            <p class="mb-2 fw-semibold">{{ $direccion->nombre_completo }}</p>
                        </div>
                        <div class="col-12">
                            <small class="text-muted">Dirección:</small>
                            <p class="mb-2 fw-semibold">{{ $direccion->direccion }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Teléfono:</small>
                            <p class="mb-2 fw-semibold">{{ $direccion->telefono }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Email:</small>
                            <p class="mb-2 fw-semibold">{{ $direccion->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Método de Pago --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-credit-card text-success me-2"></i>
                            Método de Pago
                        </h6>
                        <a href="{{ route('checkout.pago') }}" class="btn btn-sm btn-outline-success rounded-pill">
                            Editar
                        </a>
                    </div>

                    @if($pago->metodo_pago === 'tarjeta')
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-credit-card-2-front text-success fs-3"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold">Tarjeta terminada en **** {{ substr($pago->numero_tarjeta, -4) }}</p>
                                <small class="text-muted">{{ $pago->nombre_titular }}</small>
                            </div>
                        </div>
                    @endif

                    @if($pago->metodo_pago === 'yape')
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-purple bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-phone-fill text-purple fs-3"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold">Yape - 999 888 777</p>
                                <small class="text-muted">Pago móvil confirmado</small>
                            </div>
                        </div>
                    @endif

                    @if($pago->metodo_pago === 'plin')
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-phone text-primary fs-3"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold">Plin - 999 888 777</p>
                                <small class="text-muted">Pago móvil confirmado</small>
                            </div>
                        </div>
                    @endif

                    @if($pago->metodo_pago === 'transferencia')
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-bank text-info fs-3"></i>
                            </div>
                            <div>
                                <p class="mb-1 fw-semibold">Transferencia Bancaria</p>
                                <small class="text-muted">BCP - Comprobante adjuntado</small>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Productos --}}
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-box-seam text-success me-2"></i>
                            Productos ({{ count($items) }})
                        </h6>
                        <a href="{{ route('cart.index') }}" class="btn btn-sm btn-outline-success rounded-pill">
                            Editar
                        </a>
                    </div>

                    @foreach($items as $index => $item)
                        <div class="d-flex align-items-center gap-3 {{ $index < count($items) - 1 ? 'mb-3 pb-3 border-bottom' : '' }}">
                            
                            {{-- Imagen --}}
                            <div class="flex-shrink-0">
                                @if($item->producto->imagen)
                                    <img src="{{ asset('storage/' . $item->producto->imagen) }}"
                                         class="rounded-3 object-fit-cover"
                                         style="width: 70px; height: 70px;"
                                         alt="{{ $item->producto->nombre }}">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">{{ $item->producto->nombre }}</h6>
                                <small class="text-muted">
                                    Cantidad: {{ $item->cantidad }} × S/ {{ number_format($item->producto->precio, 2) }}
                                </small>
                            </div>

                            {{-- Precio --}}
                            <div class="text-end">
                                <h6 class="mb-0 fw-bold text-success">
                                    S/ {{ number_format($item->cantidad * $item->producto->precio, 2) }}
                                </h6>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- Resumen Final --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4">Resumen Final</h6>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">IGV (18%)</span>
                        <span class="fw-semibold">S/ {{ number_format($igv, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Envío</span>
                        <span class="fw-semibold">S/ {{ number_format($envio, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0 fw-bold">Total a Pagar</h5>
                        <h4 class="mb-0 fw-bold text-success">S/ {{ number_format($total, 2) }}</h4>
                    </div>

                    {{-- Botón Confirmar --}}
                    <a href="{{ route('checkout.confirmacion') }}"
                            class="btn btn-success btn-lg w-100 rounded-pill shadow-sm mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Confirmar Pedido
                    </a>

                    {{-- Botón Volver --}}
                    <a href="{{ route('checkout.pago') }}" class="btn btn-outline-secondary btn-lg w-100 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>
                        Volver al Pago
                    </a>

                    {{-- Beneficios --}}
                    <div class="mt-4 pt-4 border-top">
                        <div class="row g-3 text-center">
                            <div class="col-4">
                                <i class="bi bi-shield-check text-success fs-3 d-block mb-2"></i>
                                <small class="text-muted">Compra Segura</small>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-truck text-success fs-3 d-block mb-2"></i>
                                <small class="text-muted">Envío Rápido</small>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-arrow-repeat text-success fs-3 d-block mb-2"></i>
                                <small class="text-muted">Devolución Fácil</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>