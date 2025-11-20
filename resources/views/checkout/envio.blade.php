<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envío - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f7f7f7; }
    </style>
</head>
<body>

{{-- HEADER FIJO --}}
<div class="position-sticky top-0 bg-white shadow-sm" style="z-index: 1000;">
    
    {{-- Navegación superior --}}
    <div class="border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="{{ route('cart.index') }}" class="btn btn-link text-decoration-none text-dark">
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

    {{-- Barra de Progreso --}}
    <div class="border-bottom py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center position-relative">
                
                {{-- Línea de conexión --}}
                <div class="position-absolute top-50 start-0 end-0 border-top border-2" style="z-index: 0;"></div>

                {{-- Step 1 - Carrito (Completado) --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-lg fs-4"></i>
                    </div>
                    <small class="text-success fw-semibold">Carrito</small>
                </div>

                {{-- Step 2 - Envío (Activo) --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-truck fs-5"></i>
                    </div>
                    <small class="text-success fw-semibold">Envío</small>
                </div>

                {{-- Step 3 - Pago --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-white border border-2 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-credit-card fs-5 text-muted"></i>
                    </div>
                    <small class="text-muted">Pago</small>
                </div>

                {{-- Step 4 - Revisar --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-white border border-2 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-check-circle fs-5 text-muted"></i>
                    </div>
                    <small class="text-muted">Revisar</small>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- CONTENIDO --}}
<div class="container my-5">
    <div class="row justify-content-center">
        
        {{-- FORMULARIO CENTRADO --}}
        <div class="col-lg-7 col-md-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">

                    {{-- Título --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-truck text-success fs-3 me-2"></i>
                            <h4 class="fw-bold mb-0">Información de Envío</h4>
                        </div>
                        <p class="text-muted mb-0">Ingresa los datos para la entrega de tu pedido</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.envio.guardar') }}" method="POST">
                        @csrf

                        {{-- Nombre completo --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person text-muted me-2"></i>
                                Nombre completo *
                            </label>
                            <input type="text" 
                                   name="nombre_completo"
                                   value="{{ old('nombre_completo', $direccion->nombre_completo ?? auth()->user()->name) }}"
                                   class="form-control form-control-lg border-0 bg-light"
                                   placeholder="Ej: Juan Pérez"
                                   required>
                        </div>

                        {{-- Dirección --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-geo-alt text-muted me-2"></i>
                                Dirección de entrega *
                            </label>
                            <input type="text" 
                                   name="direccion"
                                   value="{{ old('direccion', $direccion->direccion ?? '') }}"
                                   class="form-control form-control-lg border-0 bg-light"
                                   placeholder="Ej: Av. Arequipa 123, San Isidro, Lima"
                                   required>
                        </div>

                        {{-- Teléfono --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-telephone text-muted me-2"></i>
                                Teléfono de contacto *
                            </label>
                            <input type="text" 
                                   name="telefono"
                                   value="{{ old('telefono', $direccion->telefono ?? '') }}"
                                   class="form-control form-control-lg border-0 bg-light"
                                   placeholder="999 999 999"
                                   required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-envelope text-muted me-2"></i>
                                Email de confirmación
                            </label>
                            <input type="email" 
                                   name="email"
                                   value="{{ old('email', $direccion->email ?? auth()->user()->email) }}"
                                   class="form-control form-control-lg border-0 bg-light"
                                   placeholder="jaz@gmail.com">
                            <small class="text-muted">Se enviará la confirmación a este correo</small>
                        </div>

                        {{-- Botones --}}
                        <div class="d-grid gap-2 mt-5">
                            <button type="submit"
                                class="btn btn-success btn-lg rounded-pill shadow-sm">
                                  Continuar al Pago
                                  <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>
                                Volver al Carrito
                            </a>
                        </div>

                    </form>

                </div>
            </div>
            

            {{-- Resumen del pedido pequeño --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Resumen del Pedido</h6>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Subtotal</span>
                        <span class="fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">IGV (18%)</span>
                        <span class="fw-semibold">S/ {{ number_format($igv, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">Envío</span>
                        <span class="fw-semibold">S/ {{ number_format($envio, 2) }}</span>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-4 text-success">S/ {{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>