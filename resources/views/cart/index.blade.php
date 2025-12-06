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
</head>
<body class="bg-light">

{{-- HEADER --}}
<header class="bg-white shadow-sm position-sticky top-0" style="z-index: 1030;">
    
    {{-- Barra Superior --}}
    <div class="border-bottom">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-6 col-md-auto">
                    <a href="{{ route('store.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        <span class="d-none d-sm-inline">Volver a la tienda</span>
                        <span class="d-inline d-sm-none">Volver</span>
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

                        {{-- Línea de conexión --}}
                        <div class="position-absolute top-50 start-0 end-0 translate-middle-y">
                            <div class="progress" style="height: 2px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>

                        {{-- Paso 1: Carrito --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow" style="width: 48px; height: 48px;">
                                <i class="bi bi-cart-check-fill fs-5"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Carrito</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Carrito</small>
                        </div>

                        {{-- Paso 2: Envío --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-white border border-2 border-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 48px; height: 48px;">
                                <i class="bi bi-truck fs-5 text-secondary"></i>
                            </div>
                            <small class="text-secondary d-none d-md-block">Envío</small>
                            <small class="text-secondary d-block d-md-none" style="font-size: 0.7rem;">Envío</small>
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

@if($items->isEmpty())

    {{-- CARRITO VACÍO --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm text-center p-4 p-md-5">
                <div class="mb-4">
                    <i class="bi bi-cart-x text-muted display-1"></i>
                </div>
                <h3 class="fw-bold mb-3">Tu carrito está vacío</h3>
                <p class="text-muted mb-4">Explora nuestra tienda y encuentra productos frescos del campo</p>

                <a href="{{ route('store.index') }}" class="btn btn-success btn-lg rounded-pill shadow-sm">
                    <i class="bi bi-shop me-2"></i>Explorar Productos
                </a>
            </div>
        </div>
    </div>

@else

<div class="row g-3 g-lg-4">

    {{-- COLUMNA IZQUIERDA: PRODUCTOS --}}
    <div class="col-12 col-lg-8">
        
        {{-- Encabezado --}}
        <div class="card border-0 shadow-sm mb-3 mb-md-4">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                    <div>
                        <h4 class="fw-bold mb-1 d-flex align-items-center">
                            <i class="bi bi-bag-check-fill text-success me-2"></i>
                            Mi Carrito
                        </h4>
                        <p class="text-muted mb-0 small">Revisa y ajusta tus productos</p>
                    </div>
                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                        {{ $items->count() }} {{ $items->count() == 1 ? 'artículo' : 'artículos' }}
                    </span>
                </div>
            </div>
        </div>

        @php $subtotal = 0; @endphp

        {{-- Lista de Productos --}}
        @foreach($items as $item)
            @php $subtotal += $item->producto->precio * $item->cantidad; @endphp

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-3 p-md-4">
                    <div class="row g-3 align-items-center">

                        {{-- Imagen --}}
                        <div class="col-auto">
                            @if($item->producto->imagen)
                                <img src="{{ asset('storage/'.$item->producto->imagen) }}"
                                     class="rounded-3 object-fit-cover"
                                     style="width:80px; height:80px;"
                                     alt="{{ $item->producto->nombre }}">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                     style="width:80px; height:80px;">
                                    <i class="bi bi-image text-muted fs-3"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Información del Producto --}}
                        <div class="col">
                            <h5 class="fw-bold mb-2">{{ $item->producto->nombre }}</h5>
                            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                                <span class="text-success fw-bold fs-5">
                                    S/ {{ number_format($item->producto->precio, 2) }}
                                </span>
                                <small class="text-muted">por unidad</small>
                            </div>
                        </div>

                        {{-- Controles de Cantidad --}}
                        <div class="col-12 col-md-auto">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">

                                <div class="input-group shadow-sm">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="this.nextElementSibling.stepDown(); this.form.submit();">
                                        <i class="bi bi-dash"></i>
                                    </button>

                                    <input type="number" min="1" name="cantidad" 
                                           class="form-control text-center fw-bold border-start-0 border-end-0"
                                           style="width: 60px;"
                                           value="{{ $item->cantidad }}" 
                                           onchange="this.form.submit();">

                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="this.previousElementSibling.stepUp(); this.form.submit();">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Total y Eliminar --}}
                        <div class="col-12 col-md-auto text-end">
                            <div class="d-flex flex-row flex-md-column align-items-center align-items-md-end justify-content-between gap-2">
                                <h5 class="fw-bold text-success mb-0">
                                    S/ {{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                </h5>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none">
                                        <i class="bi bi-trash-fill me-1"></i>
                                        <small>Eliminar</small>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

        {{-- Sección de Cupón --}}
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-3 p-md-4">
                
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-tag-fill text-success fs-5 me-2"></i>
                    <h6 class="fw-bold mb-0">¿Tienes un cupón de descuento?</h6>
                </div>

                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-ticket-perforated text-muted"></i>
                    </span>
                    <input type="text"
                           name="codigo_cupon"
                           id="codigoCupon"
                           class="form-control border-start-0"
                           placeholder="Ingresa tu código aquí">

                    <button type="button"
                            id="btnAplicarCupon"
                            class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i>
                        <span class="d-none d-sm-inline">Aplicar Cupón</span>
                        <span class="d-inline d-sm-none">Aplicar</span>
                    </button>
                </div>

                <div id="respuestaCupon"
                     class="alert alert-success mt-3 mb-0"
                     style="display:none;">
                </div>

                <div id="errorCupon"
                     class="alert alert-danger mt-3 mb-0"
                     style="display:none;">
                </div>
            </div>
        </div>

    </div>

    {{-- COLUMNA DERECHA: RESUMEN --}}
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm position-sticky" style="top: 100px;">
            <div class="card-body p-3 p-md-4">

                <h5 class="fw-bold mb-4 pb-3 border-bottom">
                    <i class="bi bi-receipt text-success me-2"></i>
                    Resumen del Pedido
                </h5>

                {{-- Desglose --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Subtotal ({{ $items->count() }} items)</span>
                        <span class="fw-semibold">S/ {{ number_format($subtotal, 2) }}</span>
                    </div>

                    @php $igv = $subtotal * 0.18; @endphp

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">IGV (18%)</span>
                        <span class="fw-semibold">S/ {{ number_format($igv, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Costo de envío</span>
                        <span class="fw-semibold">S/ 10.00</span>
                    </div>
                </div>

                {{-- Alerta de envío gratis --}}
                <div class="alert alert-success border-0 mb-4 py-2 px-3">
                    <small class="d-flex align-items-center">
                        <i class="bi bi-gift-fill me-2"></i>
                        Envío gratis en compras mayores a S/ 150
                    </small>
                </div>

                <hr class="my-4">

                {{-- Total --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold fs-5">Total a Pagar</span>
                    <span class="fw-bold fs-3 text-success">
                        S/ {{ number_format($subtotal + $igv + 10, 2) }}
                    </span>
                </div>

                {{-- Botón Principal --}}
                <a href="{{ route('checkout.envio') }}" 
                   class="btn btn-success btn-lg w-100 rounded-pill shadow-sm mb-3 d-flex align-items-center justify-content-center">
                    Continuar con el Envío
                    <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                </a>

                <a href="{{ route('store.index') }}" 
                   class="btn btn-outline-secondary w-100 rounded-pill">
                    <i class="bi bi-plus-circle me-2"></i>Agregar más productos
                </a>

                {{-- Métodos de Pago --}}
                <div class="text-center mt-4 pt-4 border-top">
                    <small class="text-muted d-block mb-3 fw-semibold">Métodos de pago aceptados</small>
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
                <div class="mt-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item bg-transparent border-0 px-0 py-2">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-shield-fill-check text-success fs-5 me-3"></i>
                                <div>
                                    <small class="fw-semibold d-block">Compra Protegida</small>
                                    <small class="text-muted">Transacción 100% segura</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent border-0 px-0 py-2">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-arrow-repeat text-success fs-5 me-3"></i>
                                <div>
                                    <small class="fw-semibold d-block">Devolución Sin Costo</small>
                                    <small class="text-muted">30 días para devoluciones</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent border-0 px-0 py-2">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-headset text-success fs-5 me-3"></i>
                                <div>
                                    <small class="fw-semibold d-block">Atención Continua</small>
                                    <small class="text-muted">Soporte 24/7 disponible</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endif
</main>

{{-- FOOTER --}}
<footer class="bg-white border-top mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <small class="text-muted">
                    © 2024 D'Campo - Productos frescos del campo
                </small>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('btnAplicarCupon').addEventListener('click', function () {

    let codigo = document.getElementById('codigoCupon').value.trim();
    let total = {{ isset($subtotal) ? $subtotal + (isset($igv) ? $igv : 0) + 10 : 10 }};

    // Ocultar mensajes previos
    document.getElementById('respuestaCupon').style.display = 'none';
    document.getElementById('errorCupon').style.display = 'none';

    if (codigo === "") {
        document.getElementById('errorCupon').style.display = 'block';
        document.getElementById('errorCupon').innerHTML = '<i class="bi bi-exclamation-circle me-2"></i>Por favor, ingresa un código de cupón';
        return;
    }

    fetch("{{ route('carrito.aplicarCupon') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ codigo: codigo, total: total })
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            // Mostrar mensaje de éxito
            document.getElementById('respuestaCupon').style.display = 'block';
            document.getElementById('respuestaCupon').innerHTML = 
                '<i class="bi bi-check-circle-fill me-2"></i>¡Cupón aplicado! Descuento: -S/ ' + data.descuento.toFixed(2);

            // Actualizar el total
            let nuevoTotal = total - data.descuento;
            let totalElement = document.querySelector(".fw-bold.fs-3.text-success");

            if (totalElement) {
                totalElement.innerText = "S/ " + nuevoTotal.toFixed(2);
            }

        } else {
            // Mostrar error
            document.getElementById('errorCupon').style.display = 'block';
            document.getElementById('errorCupon').innerHTML = 
                '<i class="bi bi-exclamation-triangle-fill me-2"></i>' + data.message;
        }
    })
    .catch(error => {
        document.getElementById('errorCupon').style.display = 'block';
        document.getElementById('errorCupon').innerHTML = 
            '<i class="bi bi-exclamation-triangle-fill me-2"></i>Error al aplicar el cupón. Intenta nuevamente.';
    });

});
</script>
</body>
</html>