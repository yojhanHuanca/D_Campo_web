<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Pago - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f7f7f7; }
        .metodo-pago-btn {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
        }
        .metodo-pago-btn:hover {
            border-color: #198754;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.15);
        }
        .metodo-pago-btn.active {
            border: 2px solid #198754;
            background: linear-gradient(135deg, #f0f8f4 0%, #e8f5e9 100%);
        }
        .qr-container {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            padding: 30px;
            border-radius: 20px;
        }
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
                    <a href="{{ route('checkout.envio') }}" class="btn btn-link text-decoration-none text-dark">
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
                
                <div class="position-absolute top-50 start-0 end-0 border-top border-2"></div>

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

                {{-- Pago - Activo --}}
                <div class="text-center position-relative" style="z-index: 1;">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-credit-card fs-5"></i>
                    </div>
                    <small class="text-success fw-semibold">Pago</small>
                </div>

                {{-- Revisar - Pendiente --}}
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
        <div class="col-lg-9">

            {{-- Título --}}
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-3"
                     style="width: 70px; height: 70px;">
                    <i class="bi bi-credit-card text-success fs-1"></i>
                </div>
                <h3 class="fw-bold mb-2">Método de Pago</h3>
                <p class="text-muted">Selecciona tu método de pago preferido</p>
            </div>

            <form id="formPago" action="{{ route('checkout.pago.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- BOTONES DE MÉTODOS DE PAGO --}}
                <div class="row g-3 mb-5">

                    {{-- Tarjeta --}}
                    <div class="col-md-6 col-lg-4">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_tarjeta">
                            <input type="radio" name="metodo_pago" value="tarjeta" class="d-none" />
                            <i class="bi bi-credit-card-2-front text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Tarjeta</h6>
                            <small class="text-muted">Crédito/Débito</small>
                        </label>
                    </div>

                    {{-- Yape --}}
                    <div class="col-md-6 col-lg-4">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_yape">
                            <input type="radio" name="metodo_pago" value="yape" class="d-none" />
                            <i class="bi bi-phone-fill text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Yape</h6>
                            <small class="text-muted">Pago móvil</small>
                        </label>
                    </div>

                    {{-- Plin --}}
                    <div class="col-md-6 col-lg-4">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_plin">
                            <input type="radio" name="metodo_pago" value="plin" class="d-none" />
                            <i class="bi bi-phone text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Plin</h6>
                            <small class="text-muted">Pago móvil</small>
                        </label>
                    </div>

                </div>

                {{-- CONTENIDO DINÁMICO --}}
                <div class="row">
                    <div class="col-12">

                                               {{-- TARJETA --}}
                        <div class="card border-0 shadow-sm rounded-4 d-none" id="card_tarjeta">
                            <div class="card-body p-5">
                                <h5 class="fw-bold mb-4">
                                    <i class="bi bi-credit-card-2-front text-success me-2"></i>
                                    Pago con Tarjeta
                                </h5>
                                <p class="text-muted">Aquí se cargará el formulario de Culqi</p>
                            </div>
                        </div>

                        {{-- YAPE --}}
                        <div class="card border-0 shadow-sm rounded-4 d-none" id="card_yape">
                            <div class="card-body p-5">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="qr-container text-center mb-4 mb-md-0" style="background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);">
                                            <div class="bg-white rounded-3 p-4 d-inline-block mb-3">
                                                <i class="bi bi-qr-code text-purple display-1"></i>
                                            </div>
                                            <h5 class="fw-bold text-purple mb-2">Escanea el código con Yape</h5>
                                            <p class="text-purple mb-0">
                                                <i class="bi bi-phone-fill me-1"></i>
                                                <strong>999 888 777</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4">
                                            <h5 class="fw-bold mb-2">
                                                <i class="bi bi-cash-coin me-2"></i>
                                                Monto a pagar
                                            </h5>
                                            <h2 class="text-success fw-bold mb-0">S/ {{ number_format($total, 2) }}</h2>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Código de operación *</label>
                                            <input type="text" name="codigo_operacion" 
                                                   class="form-control form-control-lg border-0 bg-light"
                                                   placeholder="Ej: 123456789">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Subir comprobante (opcional)</label>
                                            <input type="file" name="comprobante" 
                                                   class="form-control form-control-lg border-0 bg-light"
                                                   accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PLIN --}}
                        <div class="card border-0 shadow-sm rounded-4 d-none" id="card_plin">
                            <div class="card-body p-5">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="qr-container text-center mb-4 mb-md-0" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                                            <div class="bg-white rounded-3 p-4 d-inline-block mb-3">
                                                <i class="bi bi-qr-code text-primary display-1"></i>
                                            </div>
                                            <h5 class="fw-bold text-primary mb-2">Escanea el código con Plin</h5>
                                            <p class="text-primary mb-0">
                                                <i class="bi bi-phone-fill me-1"></i>
                                                <strong>999 888 777</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-success bg-success bg-opacity-10 border-0 mb-4">
                                            <h5 class="fw-bold mb-2">
                                                <i class="bi bi-cash-coin me-2"></i>
                                                Monto a pagar
                                            </h5>
                                            <h2 class="text-success fw-bold mb-0">S/ {{ number_format($total, 2) }}</h2>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Código de operación *</label>
                                            <input type="text" name="codigo_operacion" 
                                                   class="form-control form-control-lg border-0 bg-light"
                                                   placeholder="Ej: 123456789">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Subir comprobante (opcional)</label>
                                            <input type="file" name="comprobante" 
                                                   class="form-control form-control-lg border-0 bg-light"
                                                   accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mensaje inicial --}}
                        <div class="text-center py-5" id="mensaje_inicial">
                            <i class="bi bi-cursor text-muted display-1 mb-3"></i>
                            <h5 class="text-muted">Selecciona un método de pago para continuar</h5>
                        </div>

                    </div>
                </div>

                {{-- BOTONES DE NAVEGACIÓN --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="{{ route('checkout.envio') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="bi bi-arrow-left me-2"></i>
                                Volver al Envío
                            </a>
                            <button type="submit" formaction="{{ route('checkout.pago.submit') }}"
                                     class="btn btn-success btn-lg rounded-pill px-5 shadow-sm">
                                Revisar Pedido
                                <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Culqi v4 --}}
<script src="https://checkout.culqi.com/js/v4"></script>

<script>
    // ==========================
    //   LÓGICA DE TABS Y DISEÑO
    // ==========================
    const botones = {
        tarjeta: document.getElementById('btn_tarjeta'),
        yape: document.getElementById('btn_yape'),
        plin: document.getElementById('btn_plin'),
        transferencia: document.getElementById('btn_transferencia') ?? null
    };

    const cards = {
        tarjeta: document.getElementById('card_tarjeta'),
        yape: document.getElementById('card_yape'),
        plin: document.getElementById('card_plin'),
        transferencia: document.getElementById('card_transferencia') ?? null
    };

    const mensajeInicial = document.getElementById('mensaje_inicial');

    document.querySelectorAll("input[name='metodo_pago']").forEach(radio => {
        radio.addEventListener('change', function() {
            const metodo = this.value;

            Object.values(botones).forEach(btn => btn && btn.classList.remove('active'));
            Object.values(cards).forEach(card => card && card.classList.add('d-none'));

            if (botones[metodo]) botones[metodo].classList.add('active');
            if (cards[metodo]) cards[metodo].classList.remove('d-none');

            mensajeInicial.classList.add('d-none');

            // Si el usuario elige tarjeta, abrir Culqi de inmediato
            if (metodo === 'tarjeta') {
                lanzarCulqi();
            }
        });
    });

    // ==========================
    //   INTEGRACIÓN CULQI TARJETA
    // ==========================

    // Llave pública desde .env
    Culqi.publicKey = "{{ env('CULQI_PUBLIC_KEY') }}";

    const formPago = document.getElementById('formPago');

    formPago.addEventListener('submit', function (e) {
        const metodoSeleccionado = document.querySelector("input[name='metodo_pago']:checked")?.value;

        // Solo interceptamos TARJETA. Yape / Plin siguen normal.
        if (metodoSeleccionado === 'tarjeta') {
            e.preventDefault();  // No mandamos el form a Laravel todavía

            lanzarCulqi();
        }
    });

    let culqiConfigurado = false;
    function configurarCulqi() {
        if (culqiConfigurado) return;
        Culqi.options({
            lang: "es",
            modal: true,
            installments: false
        });

        Culqi.settings({
            title: "D'Campo",
            currency: "PEN",
            amount: {{ intval($total * 100) }},          // Monto en centavos
            email: "{{ auth()->user()->email }}"
        });

        culqiConfigurado = true;
    }

    function lanzarCulqi() {
        configurarCulqi();
        Culqi.open();
    }

    // Cuando Culqi genera el token correctamente
    function enviarTokenCulqi(tokenId) {
        try { Culqi.close(); } catch (e) {}

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('culqi.pagar') }}";

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = 'token';
        tokenInput.value = tokenId;
        form.appendChild(tokenInput);

        document.body.appendChild(form);
        form.submit();
    }

    Culqi.on('token', function (token) {
        enviarTokenCulqi(token.id);
    });

    // Callback global que Culqi v4 llama tras tokenizar
    window.culqi = function () {
        if (Culqi.token) {
            enviarTokenCulqi(Culqi.token.id);
        } else if (Culqi.error) {
            alert(Culqi.error.user_message || 'Error en Culqi, intenta nuevamente.');
            try { Culqi.close(); } catch (e) {}
        }
    };

    // Si Culqi devuelve error antes de tokenizar
    Culqi.on('error', function (error) {
        alert(error.user_message || 'Error en Culqi, intenta nuevamente.');
    });

    // Al elegir tarjeta se abre Culqi (sin esperar a "Revisar pedido")
</script>


</body>
</html>
