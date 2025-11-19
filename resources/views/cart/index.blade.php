<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - D'Campo</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICONOS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background:#f7f7f7; }
    </style>
</head>
<body>

{{-- HEADER PERSONALIZADO (SIN EL HEADER GENERAL DEL SISTEMA) --}}
<div class="position-sticky top-0 bg-white shadow-sm" style="z-index: 1000;">

    {{-- Volver --}}
    <div class="border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="{{ route('store.index') }}" class="btn btn-link text-decoration-none text-dark">
                        <i class="bi bi-arrow-left me-2"></i>Volver a la tienda
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

                <div class="position-absolute top-50 start-0 end-0 border-top border-2" style="z-index: 0;"></div>

                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-cart-fill fs-5"></i>
                    </div>
                    <small class="fw-semibold text-success">Carrito</small>
                </div>

                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-white border border-2 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-truck fs-5 text-muted"></i>
                    </div>
                    <small class="text-muted">Envío</small>
                </div>

                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-white border border-2 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-credit-card fs-5 text-muted"></i>
                    </div>
                    <small class="text-muted">Pago</small>
                </div>

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

@if($items->isEmpty())

    {{-- CARRITO VACÍO --}}
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                <div class="mb-4">
                    <i class="bi bi-cart-x text-muted" style="font-size: 5rem;"></i>
                </div>
                <h3 class="fw-bold mb-3">Tu carrito está vacío</h3>
                <p class="text-muted mb-4">Agrega productos a tu carrito para continuar con tu compra</p>

                <a href="{{ route('store.index') }}" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                    <i class="bi bi-shop me-2"></i>Ir a la tienda
                </a>
            </div>
        </div>
    </div>

@else

<div class="row g-4">

    {{-- LISTA DE PRODUCTOS --}}
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-cart-fill text-success me-2"></i>Tu Carrito de Compras
                </h4>
                <p class="text-muted mb-0 small">Revisa tus productos antes de continuar</p>
            </div>
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                {{ $items->count() }} {{ $items->count() == 1 ? 'producto' : 'productos' }}
            </span>
        </div>

        @php $subtotal = 0; @endphp

        @foreach($items as $item)
            @php $subtotal += $item->producto->precio * $item->cantidad; @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
                <div class="card-body p-4">

                    <div class="row align-items-center g-3">

                        {{-- Imagen --}}
                        <div class="col-auto">
                            @if($item->producto->imagen)
                                <img src="{{ asset('storage/'.$item->producto->imagen) }}"
                                     class="rounded-3 object-fit-cover"
                                     style="width:100px;height:100px;"
                                     alt="{{ $item->producto->nombre }}">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                     style="width:100px;height:100px;">
                                    <i class="bi bi-image text-muted fs-3"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Información --}}
                        <div class="col">
                            <h5 class="fw-bold mb-2">{{ $item->producto->nombre }}</h5>
                            <p class="text-success fw-bold fs-5 mb-0">
                                S/ {{ number_format($item->producto->precio,2) }}
                            </p>
                            <small class="text-muted">Precio unitario</small>
                        </div>

                        {{-- Cantidad --}}
                        <div class="col-auto">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">

                                <div class="input-group shadow-sm" style="width:130px;">
                                    <button type="button" class="btn btn-outline-secondary border-end-0"
                                            onclick="this.nextElementSibling.stepDown(); this.form.submit();">
                                        <i class="bi bi-dash"></i>
                                    </button>

                                    <input type="number" min="1" name="cantidad" class="form-control text-center border-start-0 border-end-0 fw-bold"
                                           value="{{ $item->cantidad }}" onchange="this.form.submit();">

                                    <button type="button" class="btn btn-outline-secondary border-start-0"
                                            onclick="this.previousElementSibling.stepUp(); this.form.submit();">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Total + eliminar --}}
                        <div class="col-auto text-end">
                            <h5 class="fw-bold text-success mb-3">
                                S/ {{ number_format($item->producto->precio * $item->cantidad, 2) }}
                            </h5>

                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button class="btn btn-link text-danger p-0 text-decoration-none small">
                                    <i class="bi bi-trash-fill me-1"></i>Eliminar
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        @endforeach

        {{-- CUPÓN --}}
        <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-tag-fill text-success fs-5 me-2"></i>
                    <h6 class="fw-bold mb-0">Cupón de Descuento</h6>
                </div>

                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" class="form-control bg-light border-0" placeholder="Ingresa tu código">
                    <button class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i>Aplicar
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- RESUMEN --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top:100px;">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-4 pb-3 border-bottom">Resumen del Pedido</h5>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-semibold">S/ {{ number_format($subtotal,2) }}</span>
                </div>

                @php $igv = $subtotal * 0.18; @endphp

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">IGV (18%)</span>
                    <span class="fw-semibold">S/ {{ number_format($igv,2) }}</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Envío</span>
                    <span class="fw-semibold">S/ 10.00</span>
                </div>

                <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4 py-2">
                    <small class="text-success">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        Envío gratis en compras mayores a S/ 150
                    </small>
                </div>

                <hr class="my-3">

                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-4 text-success">
                        S/ {{ number_format($subtotal + $igv + 10, 2) }}
                    </span>
                </div>

                <a href="{{ route('checkout.envio') }}" 
                    class="btn btn-success btn-lg w-100 rounded-pill shadow-sm mb-3">
                     Continuar al Envío 
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>

                {{-- Métodos de pago --}}
                <div class="text-center mt-4 pt-3 border-top">
                    <small class="text-muted d-block mb-3 fw-semibold">Métodos de pago disponibles</small>
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="bi bi-credit-card me-1"></i>Visa
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="bi bi-credit-card me-1"></i>Mastercard
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="bi bi-wallet2 me-1"></i>Yape
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-2">
                            <i class="bi bi-phone me-1"></i>Plin
                        </span>
                    </div>
                </div>

                {{-- Garantías --}}
                <div class="mt-4 p-3 bg-light rounded-3">
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-shield-check text-success fs-5 me-2"></i>
                        <div>
                            <small class="fw-semibold d-block text-dark">Compra 100% segura</small>
                            <small class="text-muted">Protección garantizada</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-arrow-repeat text-success fs-5 me-2"></i>
                        <div>
                            <small class="fw-semibold d-block text-dark">Devolución gratis</small>
                            <small class="text-muted">Hasta 30 días</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="bi bi-headset text-success fs-5 me-2"></i>
                        <div>
                            <small class="fw-semibold d-block text-dark">Soporte 24/7</small>
                            <small class="text-muted">Siempre disponibles</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>