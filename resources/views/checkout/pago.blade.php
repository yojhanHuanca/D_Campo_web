<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Pago - D'Campo</title>
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
                    <a href="{{ route('checkout.envio') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        <span class="d-none d-sm-inline">Volver al envío</span>
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
                                <div class="progress-bar bg-success" role="progressbar" style="width: 66%"></div>
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

                        {{-- Paso 3: Pago (Activo) --}}
                        <div class="text-center position-relative bg-light px-2" style="z-index: 1;">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 shadow" style="width: 48px; height: 48px;">
                                <i class="bi bi-credit-card-fill fs-5"></i>
                            </div>
                            <small class="fw-semibold text-success d-none d-md-block">Pago</small>
                            <small class="fw-semibold text-success d-block d-md-none" style="font-size: 0.7rem;">Pago</small>
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
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-9">

            {{-- Encabezado --}}
            <div class="text-center mb-4 mb-md-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-credit-card-2-front-fill text-success display-6"></i>
                </div>
                <h3 class="fw-bold mb-2">Método de Pago</h3>
                <p class="text-muted mb-0">Elige cómo quieres pagar tu pedido de forma segura</p>
            </div>

            <form id="formPago" action="{{ route('checkout.pago.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- MÉTODOS DE PAGO --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3 p-md-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-wallet2 text-success me-2"></i>
                            Selecciona tu método de pago
                        </h5>

                        <div class="row g-3">

                            {{-- Tarjeta --}}
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="radio" class="btn-check" name="metodo_pago" value="tarjeta" id="btn_tarjeta" autocomplete="off">
                                <label class="btn btn-outline-success w-100 h-100 py-4 d-flex flex-column align-items-center justify-content-center" for="btn_tarjeta">
                                    <i class="bi bi-credit-card-2-front-fill fs-1 mb-3"></i>
                                    <h6 class="fw-bold mb-1">Tarjeta</h6>
                                    <small class="text-muted">Crédito o Débito</small>
                                    <div class="mt-3 d-flex gap-2">
                                        <i class="bi bi-credit-card-fill text-primary"></i>
                                        <i class="bi bi-credit-card-fill text-warning"></i>
                                    </div>
                                </label>
                            </div>

                            {{-- Yape --}}
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="radio" class="btn-check" name="metodo_pago" value="yape" id="btn_yape" autocomplete="off">
                                <label class="btn btn-outline-success w-100 h-100 py-4 d-flex flex-column align-items-center justify-content-center" for="btn_yape" style="background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);">
                                    <i class="bi bi-phone-fill fs-1 mb-3" style="color: #6b2c91;"></i>
                                    <h6 class="fw-bold mb-1">Yape</h6>
                                    <small class="text-muted">Pago inmediato</small>
                                    <div class="mt-3">
                                        <span class="badge rounded-pill" style="background-color: #6b2c91;">Rápido</span>
                                    </div>
                                </label>
                            </div>

                            {{-- Plin --}}
                            <div class="col-12 col-sm-6 col-lg-4">
                                <input type="radio" class="btn-check" name="metodo_pago" value="plin" id="btn_plin" autocomplete="off">
                                <label class="btn btn-outline-success w-100 h-100 py-4 d-flex flex-column align-items-center justify-content-center" for="btn_plin" style="background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);">
                                    <i class="bi bi-phone fs-1 mb-3 text-primary"></i>
                                    <h6 class="fw-bold mb-1">Plin</h6>
                                    <small class="text-muted">Pago inmediato</small>
                                    <div class="mt-3">
                                        <span class="badge bg-primary rounded-pill">Seguro</span>
                                    </div>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- CONTENIDO DINÁMICO --}}
                
                {{-- Mensaje inicial --}}
                <div class="card border-0 shadow-sm text-center py-5" id="mensaje_inicial">
                    <div class="card-body">
                        <i class="bi bi-hand-index text-muted display-1 mb-3"></i>
                        <h5 class="text-muted mb-2">Selecciona un método de pago</h5>
                        <p class="text-muted small mb-0">Elige tu opción preferida para continuar</p>
                    </div>
                </div>

                {{-- TARJETA --}}
                <div class="card border-0 shadow-sm d-none" id="card_tarjeta">
                    <div class="card-body p-3 p-md-4 p-lg-5">
                        <div class="row align-items-center mb-4">
                            <div class="col">
                                <h5 class="fw-bold mb-1">
                                    <i class="bi bi-credit-card-2-front-fill text-success me-2"></i>
                                    Pago con Tarjeta
                                </h5>
                                <p class="text-muted mb-0 small">Procesado de forma segura por Culqi</p>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex gap-2">
                                    <i class="bi bi-credit-card-fill text-primary fs-3"></i>
                                    <i class="bi bi-credit-card-fill text-warning fs-3"></i>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 d-flex align-items-start mb-4">
                            <i class="bi bi-shield-lock-fill text-info fs-4 me-3 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Pago 100% seguro</strong>
                                <small>Tus datos están protegidos con encriptación SSL de última generación</small>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <p class="text-muted mb-3">El formulario de pago se abrirá automáticamente</p>
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>

                        <div id="culqiError" class="alert alert-danger d-none"></div>
                    </div>
                </div>

                {{-- YAPE --}}
                <div class="card border-0 shadow-sm d-none" id="card_yape">
                    <div class="card-body p-3 p-md-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-phone-fill me-2" style="color: #6b2c91;"></i>
                            Pagar con Yape
                        </h5>

                        <div class="row g-4">
                            {{-- Columna izquierda: QR --}}
                            <div class="col-12 col-md-6">
                                <div class="text-center p-4 rounded-3" style="background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);">
                                    <div class="bg-white rounded-3 p-4 shadow-sm mb-3">
                                        <i class="bi bi-qr-code display-1" style="color: #6b2c91;"></i>
                                    </div>
                                    <h6 class="fw-bold mb-2" style="color: #6b2c91;">
                                        <i class="bi bi-phone-fill me-2"></i>
                                        Escanea con Yape
                                    </h6>
                                    <p class="mb-0 fw-bold fs-5" style="color: #6b2c91;">999 888 777</p>
                                </div>

                                <div class="alert alert-light border mt-3 mb-0">
                                    <small class="d-block mb-2">
                                        <i class="bi bi-1-circle-fill text-success me-2"></i>
                                        Abre tu app Yape
                                    </small>
                                    <small class="d-block mb-2">
                                        <i class="bi bi-2-circle-fill text-success me-2"></i>
                                        Escanea el código QR
                                    </small>
                                    <small class="d-block">
                                        <i class="bi bi-3-circle-fill text-success me-2"></i>
                                        Ingresa el código aquí
                                    </small>
                                </div>
                            </div>

                            {{-- Columna derecha: Formulario --}}
                            <div class="col-12 col-md-6">
                                <div class="bg-success bg-opacity-10 rounded-3 p-4 mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <small class="text-success d-block mb-1">Monto a pagar</small>
                                            <h2 class="text-success fw-bold mb-0">S/ {{ number_format($total, 2) }}</h2>
                                        </div>
                                        <i class="bi bi-cash-coin text-success display-4"></i>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Código de operación
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-hash text-muted"></i>
                                        </span>
                                    <input type="text" 
                                           name="codigo_operacion" 
                                           data-metodo-codigo="yape"
                                           class="form-control border-start-0"
                                           placeholder="Ej: 123456789">
                                    </div>
                                    <small class="text-muted">Aparece en tu confirmación de Yape</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Captura de pantalla (opcional)
                                    </label>
                                    <input type="file" 
                                           name="comprobante" 
                                           class="form-control form-control-lg shadow-sm"
                                           accept="image/*">
                                    <small class="text-muted">Ayuda a verificar tu pago más rápido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PLIN --}}
                <div class="card border-0 shadow-sm d-none" id="card_plin">
                    <div class="card-body p-3 p-md-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-phone text-primary me-2"></i>
                            Pagar con Plin
                        </h5>

                        <div class="row g-4">
                            {{-- Columna izquierda: QR --}}
                            <div class="col-12 col-md-6">
                                <div class="text-center p-4 rounded-3" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                                    <div class="bg-white rounded-3 p-4 shadow-sm mb-3">
                                        <i class="bi bi-qr-code display-1 text-primary"></i>
                                    </div>
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="bi bi-phone-fill me-2"></i>
                                        Escanea con Plin
                                    </h6>
                                    <p class="mb-0 fw-bold text-primary fs-5">999 888 777</p>
                                </div>

                                <div class="alert alert-light border mt-3 mb-0">
                                    <small class="d-block mb-2">
                                        <i class="bi bi-1-circle-fill text-primary me-2"></i>
                                        Abre tu app Plin
                                    </small>
                                    <small class="d-block mb-2">
                                        <i class="bi bi-2-circle-fill text-primary me-2"></i>
                                        Escanea el código QR
                                    </small>
                                    <small class="d-block">
                                        <i class="bi bi-3-circle-fill text-primary me-2"></i>
                                        Ingresa el código aquí
                                    </small>
                                </div>
                            </div>

                            {{-- Columna derecha: Formulario --}}
                            <div class="col-12 col-md-6">
                                <div class="bg-success bg-opacity-10 rounded-3 p-4 mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <small class="text-success d-block mb-1">Monto a pagar</small>
                                            <h2 class="text-success fw-bold mb-0">S/ {{ number_format($total, 2) }}</h2>
                                        </div>
                                        <i class="bi bi-cash-coin text-success display-4"></i>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Código de operación
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-hash text-muted"></i>
                                        </span>
                                         <input type="text" 
                                                name="codigo_operacion" 
                                                data-metodo-codigo="plin"
                                                class="form-control border-start-0"
                                                placeholder="Ej: 123456789">
                                    </div>
                                    <small class="text-muted">Aparece en tu confirmación de Plin</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Captura de pantalla (opcional)
                                    </label>
                                    <input type="file" 
                                           name="comprobante" 
                                           class="form-control form-control-lg shadow-sm"
                                           accept="image/*">
                                    <small class="text-muted">Ayuda a verificar tu pago más rápido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTONES DE NAVEGACIÓN --}}
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-3 p-md-4">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <a href="{{ route('checkout.envio') }}" class="btn btn-outline-secondary btn-lg w-100 rounded-pill">
                                    <i class="bi bi-arrow-left-circle me-2"></i>
                                    Volver al Envío
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="submit" 
                                        formaction="{{ route('checkout.pago.submit') }}"
                                        class="btn btn-success btn-lg w-100 rounded-pill shadow-sm">
                                    Revisar mi Pedido
                                    <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            {{-- Información de Seguridad --}}
            <div class="row g-3 mt-4">
                <div class="col-12 col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-shield-lock-fill text-success fs-2 mb-2"></i>
                            <small class="fw-semibold d-block">Pago Seguro</small>
                            <small class="text-muted">Encriptación SSL</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-lightning-charge-fill text-success fs-2 mb-2"></i>
                            <small class="fw-semibold d-block">Pago Rápido</small>
                            <small class="text-muted">Confirmación inmediata</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-headset text-success fs-2 mb-2"></i>
                            <small class="fw-semibold d-block">Soporte 24/7</small>
                            <small class="text-muted">Siempre disponibles</small>
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
                    <i class="bi bi-shield-check me-1"></i>
                    Transacciones protegidas - © 2024 D'Campo
                </small>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Culqi v4 --}}
<script src="https://checkout.culqi.com/js/v4"></script>

<script>
    // ==========================
    //   LÓGICA DE MÉTODOS DE PAGO
    // ==========================
    const cards = {
        tarjeta: document.getElementById('card_tarjeta'),
        yape: document.getElementById('card_yape'),
        plin: document.getElementById('card_plin')
    };
    const mensajeInicial = document.getElementById('mensaje_inicial');
    const codigosOperacion = document.querySelectorAll("input[data-metodo-codigo]");

    document.querySelectorAll("input[name='metodo_pago']").forEach(radio => {
        radio.addEventListener('change', function() {
            const metodo = this.value;

            Object.values(cards).forEach(card => card && card.classList.add('d-none'));
            cards[metodo]?.classList.remove('d-none');
            mensajeInicial?.classList.add('d-none');

            codigosOperacion.forEach(inp => {
                inp.removeAttribute('required');
                inp.setAttribute('disabled', 'disabled');
                inp.closest('.input-group')?.classList.remove('is-invalid');
            });

            if (metodo === 'tarjeta') {
                setTimeout(() => abrirCulqi(), 300);
            } else if (metodo === 'yape' || metodo === 'plin') {
                codigosOperacion.forEach(inp => {
                    if (inp.dataset.metodoCodigo === metodo) {
                        inp.removeAttribute('disabled');
                        inp.setAttribute('required', 'required');
                    }
                });
            }
        });
    });

    // ==========================
    //   INTEGRACIÓN CULQI
    // ==========================
    const culqiPublicKey = "{{ env('CULQI_PUBLIC_KEY') }}";
    const culqiAmount = {{ intval($total * 100) }};
    Culqi.publicKey = culqiPublicKey || '';
    const formPago = document.getElementById('formPago');
    const culqiErrorBox = document.getElementById('culqiError');

    function mostrarErrorCulqi(msg) {
        if (culqiErrorBox) {
            culqiErrorBox.textContent = msg;
            culqiErrorBox.classList.remove('d-none');
        } else {
            alert(msg);
        }
    }

    formPago.addEventListener('submit', function (e) {
        const metodoSeleccionado = document.querySelector("input[name='metodo_pago']:checked")?.value;
        if (!metodoSeleccionado) {
            e.preventDefault();
            mostrarErrorCulqi('Selecciona un método de pago.');
            return;
        }
        if (metodoSeleccionado === 'tarjeta') {
            e.preventDefault();
            abrirCulqi();
        }
    });

    function abrirCulqi() {
        if (!culqiPublicKey) {
            mostrarErrorCulqi('Falta la llave pública de Culqi (CULQI_PUBLIC_KEY).');
            return;
        }
        if (culqiAmount <= 0) {
            mostrarErrorCulqi('El monto a pagar debe ser mayor a 0.');
            return;
        }
        Culqi.options({ lang: "es", modal: true, installments: false });
        Culqi.settings({
            title: "D'Campo",
            currency: "PEN",
            amount: culqiAmount,
            email: "{{ auth()->user()->email }}"
        });
        Culqi.open();
    }

    function enviarTokenCulqi(tokenId) {
        try { Culqi.close(); } catch (e) {}
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('culqi.pagar') }}";
        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="${tokenId}">
        `;
        document.body.appendChild(form);
        form.submit();
    }

    Culqi.on('token', function (token) {
        enviarTokenCulqi(token.id);
    });

    window.culqi = function () {
        if (Culqi.token) {
            enviarTokenCulqi(Culqi.token.id);
        } else if (Culqi.error) {
            console.error('Culqi error:', Culqi.error);
            mostrarErrorCulqi(Culqi.error.user_message || 'Error en Culqi, intenta nuevamente.');
            try { Culqi.close(); } catch (e) {}
        }
    };

    Culqi.on('error', function (error) {
        console.error('Culqi error (on error):', error);
        mostrarErrorCulqi(error.user_message || 'Error en Culqi, intenta nuevamente.');
    });
</script>

</body>
</html>
