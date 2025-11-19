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

            <form action="{{ route('checkout.pago.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- BOTONES DE MÉTODOS DE PAGO --}}
                <div class="row g-3 mb-5">
                    
                    {{-- Tarjeta --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_tarjeta">
                            <input type="radio" name="metodo_pago" value="tarjeta" class="d-none">
                            <i class="bi bi-credit-card-2-front text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Tarjeta</h6>
                            <small class="text-muted">Crédito/Débito</small>
                        </label>
                    </div>

                    {{-- Yape --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_yape">
                            <input type="radio" name="metodo_pago" value="yape" class="d-none">
                            <i class="bi bi-phone-fill text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Yape</h6>
                            <small class="text-muted">Pago móvil</small>
                        </label>
                    </div>

                    {{-- Plin --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_plin">
                            <input type="radio" name="metodo_pago" value="plin" class="d-none">
                            <i class="bi bi-phone text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Plin</h6>
                            <small class="text-muted">Pago móvil</small>
                        </label>
                    </div>

                    {{-- Transferencia --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="metodo-pago-btn card border-2 h-100 text-center p-4 rounded-4" id="btn_transferencia">
                            <input type="radio" name="metodo_pago" value="transferencia" class="d-none">
                            <i class="bi bi-bank text-success fs-1 d-block mb-3"></i>
                            <h6 class="fw-bold mb-1">Transferencia</h6>
                            <small class="text-muted">Bancaria</small>
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
                                    Información de Tarjeta
                                </h5>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Número de Tarjeta *</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="bi bi-credit-card"></i>
                                        </span>
                                        <input type="text" name="numero_tarjeta" 
                                               class="form-control border-0 bg-light" 
                                               placeholder="1234 5678 9012 3456"
                                               maxlength="19">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Nombre del Titular *</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="text" name="nombre_titular" 
                                               class="form-control border-0 bg-light" 
                                               placeholder="JUAN PÉREZ"
                                               style="text-transform: uppercase;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Fecha de Vencimiento *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="bi bi-calendar"></i>
                                            </span>
                                            <input type="text" name="vencimiento" 
                                                   class="form-control border-0 bg-light" 
                                                   placeholder="MM/AA"
                                                   maxlength="5">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">CVV *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="text" name="cvv" 
                                                   class="form-control border-0 bg-light" 
                                                   placeholder="123"
                                                   maxlength="3">
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info bg-info bg-opacity-10 border-0">
                                    <i class="bi bi-shield-check me-2"></i>
                                    <small>Tu información está protegida con encriptación SSL</small>
                                </div>
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

                        {{-- TRANSFERENCIA --}}
                        <div class="card border-0 shadow-sm rounded-4 d-none" id="card_transferencia">
                            <div class="card-body p-5">
                                <h5 class="fw-bold mb-4">
                                    <i class="bi bi-bank text-success me-2"></i>
                                    Datos para Transferencia
                                </h5>

                                <div class="alert alert-warning bg-warning bg-opacity-10 border-0 mb-4">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <small>Envía tu comprobante de pago después de realizar la transferencia</small>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted small">BANCO</label>
                                        <div class="p-3 bg-light rounded-3 fw-bold">
                                            <i class="bi bi-bank2 text-success me-2"></i>
                                            BCP - Banco de Crédito del Perú
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-muted small">CUENTA CORRIENTE</label>
                                        <div class="p-3 bg-light rounded-3 fw-bold">
                                            194-2345678-0-99
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold text-muted small">CCI</label>
                                        <div class="p-3 bg-light rounded-3 fw-bold">
                                            002-194-002345678099-12
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold text-muted small">TITULAR</label>
                                        <div class="p-3 bg-light rounded-3 fw-bold">
                                            D'Campo Productos Naturales SAC
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="form-label fw-semibold">Subir comprobante de pago *</label>
                                    <input type="file" name="comprobante" 
                                           class="form-control form-control-lg border-0 bg-light"
                                           accept="image/*">
                                    <small class="text-muted">Sube una foto del voucher de transferencia</small>
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
<script>
    const botones = {
        tarjeta: document.getElementById('btn_tarjeta'),
        yape: document.getElementById('btn_yape'),
        plin: document.getElementById('btn_plin'),
        transferencia: document.getElementById('btn_transferencia')
    };

    const cards = {
        tarjeta: document.getElementById('card_tarjeta'),
        yape: document.getElementById('card_yape'),
        plin: document.getElementById('card_plin'),
        transferencia: document.getElementById('card_transferencia')
    };

    const mensajeInicial = document.getElementById('mensaje_inicial');

    // Escuchar cambios en los radios
    document.querySelectorAll("input[name='metodo_pago']").forEach(radio => {
        radio.addEventListener('change', function() {
            const metodo = this.value;

            // Remover clase active de todos
            Object.values(botones).forEach(btn => btn.classList.remove('active'));
            
            // Agregar active al seleccionado
            botones[metodo].classList.add('active');

            // Ocultar todos los cards
            Object.values(cards).forEach(card => card.classList.add('d-none'));
            
            // Mostrar el card seleccionado
            cards[metodo].classList.remove('d-none');

            // Ocultar mensaje inicial
            mensajeInicial.classList.add('d-none');
        });
    });
</script>

</body>
</html>