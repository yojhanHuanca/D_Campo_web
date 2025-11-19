<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8faf7 0%, #eef5ed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            {{-- Logo Superior --}}
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center gap-2">
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 45px; height: 45px;">
                        <span class="fw-bold text-success fs-5">D</span>
                    </div>
                    <span class="fw-bold fs-5">D'CAMPO</span>
                </div>
            </div>

            {{-- Card Principal --}}
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">

                    {{-- Icono de Éxito --}}
                    <div class="text-center mb-3">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                             style="width: 70px; height: 70px;">
                            <i class="bi bi-check-lg text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-2">
                            🎉 ¡Gracias por tu compra!
                        </h5>
                        <p class="text-muted small mb-0">
                            Tu pedido ha sido registrado exitosamente. Te enviamos un correo de confirmación.
                        </p>
                    </div>

                    {{-- Código de Seguimiento --}}
                    <div class="bg-light rounded-3 p-3 mb-3">
                        <div class="text-center mb-2">
                            <i class="bi bi-box-seam text-success"></i>
                            <small class="fw-bold text-success ms-1">Código de seguimiento</small>
                        </div>

                        <div class="bg-white border border-success border-2 border-opacity-25 rounded-3 p-3 text-center mb-2"
                             style="border-style: dashed !important;">
                            <h4 class="fw-bold text-success mb-0 font-monospace">
                                {{ $codigo_seguimiento }}
                            </h4>
                        </div>

                        <p class="text-center text-muted small mb-0">
                            Guarda este código para rastrear tu pedido
                        </p>
                    </div>

                    {{-- Botones de Acción --}}
                    <div class="d-grid gap-2 mb-3">
                        <a href="{{ route('perfil.pedidos') }}" 
                           class="btn btn-success rounded-pill shadow-sm">
                            <i class="bi bi-list-check me-2"></i>
                            Ver Mis Pedidos
                        </a>

                        <a href="{{ route('store.index') }}" 
                           class="btn btn-outline-secondary rounded-pill">
                            Seguir Comprando
                        </a>
                    </div>

                    {{-- Información Adicional --}}
                    <div class="pt-3 border-top">
                        <div class="row g-2 text-center">
                            <div class="col-4">
                                <i class="bi bi-envelope-check text-success fs-4 d-block mb-1"></i>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Email enviado</small>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-truck text-success fs-4 d-block mb-1"></i>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Envío activo</small>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-headset text-success fs-4 d-block mb-1"></i>
                                <small class="text-muted d-block" style="font-size: 0.7rem;">Soporte 24/7</small>
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