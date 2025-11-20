<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Detalle</title>
</head>
<body>
    @extends('layouts.perfil')

@section('content')
<div class="container py-4">

    <div class="row">
        {{-- Sidebar de perfil al fondo (como en la vista normal) --}}
        <div class="col-md-3">
            @include('perfil.sidebar')
        </div>

        <div class="col-md-9">
            {{-- Aquí podría ir el contenido de "Mis pedidos" si quieres, 
                 pero no es obligatorio porque el modal lo tapa. --}}
        </div>
    </div>

</div>

{{-- OVERLAY OSCURO + BLUR SOBRE TODA LA PANTALLA --}}
<div class="position-fixed top-0 start-0 w-100 h-100"
     style="
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        background: rgba(0,0,0,0.35);
        z-index: 1040;
     ">
</div>

{{-- MODAL CENTRADO (DETALLE DEL PEDIDO) --}}
<div class="position-fixed top-50 start-50 translate-middle"
     style="z-index:1050; width: 620px; max-width: 95%; max-height: 90vh; overflow-y:auto;">

    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">

            {{-- CABECERA --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-bold mb-1">
                        Detalle del Pedido #DC-{{ $pedido->id }}
                    </h5>
                    <small class="text-muted">
                        Información completa de tu pedido, productos comprados y estado de envío
                    </small>
                </div>

                {{-- Botón cerrar (X) --}}
                <a href="{{ route('perfil.pedidos') }}"
                   class="text-muted fs-4"
                   style="text-decoration:none; line-height:1;">
                    &times;
                </a>
            </div>

            {{-- FECHA + ESTADO --}}
            <div class="row g-3 mb-3">

                <div class="col-md-6">
                    <div class="p-3 rounded-4 border" style="background:#f5fdf7;">
                        <small class="text-muted d-block mb-1">Fecha del pedido</small>
                        <div class="d-flex align-items-center fw-semibold">
                            <i class="bi bi-clock me-2 text-success"></i>
                            <span>
                                {{ $pedido->created_at->locale('es')->translatedFormat('d \d\e F \d\e\l Y, h:i a') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Estado del pedido --}}
<div class="col-md-6">
    <div class="p-3 rounded-4 border" style="background:#fff8e6;">
        <small class="text-muted d-block mb-1">Estado del pedido</small>

        @php
            $estados = [
                'pendiente'   => ['color' => 'warning text-dark', 'icon' => 'hourglass-split'],
                'pagado'      => ['color' => 'info',             'icon' => 'credit-card'],
                'empaquetado' => ['color' => 'primary',          'icon' => 'box-seam'],
                'en_transito' => ['color' => 'secondary',        'icon' => 'truck'],
                'entregado'   => ['color' => 'success',          'icon' => 'check-circle'],
                'cancelado'   => ['color' => 'danger',           'icon' => 'x-circle'],
            ];

            $estado = $pedido->estado;
            $color = $estados[$estado]['color'] ?? 'secondary';
            $icono = $estados[$estado]['icon'] ?? 'question-circle';
        @endphp

        <span class="badge rounded-pill bg-{{ $color }} px-3 py-2">
            <i class="bi bi-{{ $icono }} me-1"></i>
            {{ ucfirst(str_replace('_', ' ', $estado)) }}
        </span>
    </div>
</div>

            </div>

            {{-- PRODUCTOS COMPRADOS --}}
            <h6 class="fw-bold mb-2">
                <i class="bi bi-bag-check me-2"></i> Productos comprados
            </h6>

            @foreach ($pedido->items as $item)
                <div class="border rounded-4 p-3 mb-2 d-flex align-items-center">

                    {{-- Imagen del producto --}}
                    <img src="{{ asset('storage/' . $item->producto->imagen) }}"
                         alt="Producto"
                         class="rounded me-3"
                         style="width:70px; height:70px; object-fit:cover;">

                    {{-- Información --}}
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1">{{ $item->producto->nombre }}</h6>
                        <small class="text-muted d-block">
                            Cantidad: {{ $item->cantidad }}
                        </small>
                        <small class="text-muted">
                            Precio unitario: S/ {{ number_format($item->precio, 2) }}
                        </small>
                    </div>

                    {{-- Total por producto --}}
                    <div class="text-end">
                        <span class="fw-bold text-success">
                            S/ {{ number_format($item->cantidad * $item->precio, 2) }}
                        </span>
                    </div>

                </div>
            @endforeach

            {{-- CÓDIGO DE SEGUIMIENTO --}}
            <div class="p-3 rounded-4 border my-3" style="background:#eef7ff;">
                <small class="text-muted d-block mb-1">Código de seguimiento</small>
                <div class="d-flex align-items-center">
                    <i class="bi bi-truck me-2 text-primary"></i>
                    <span class="fw-semibold">{{ $pedido->codigo_seguimiento }}</span>
                </div>
            </div>

            {{-- MÉTODO DE PAGO + TOTAL --}}
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="p-3 rounded-4 border" style="background:#eaffea;">
                        <small class="text-muted d-block mb-1">Método de pago</small>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-credit-card me-2 text-success"></i>
                            <span class="fw-semibold">Tarjeta de crédito/débito</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-4 border" style="background:#f7fff0;">
                        <small class="text-muted d-block mb-1">Total pagado</small>
                        <span class="fw-bold text-success fs-5">
                            S/ {{ number_format($pedido->total, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- DIRECCIÓN DE ENVÍO --}}
            <div class="p-3 rounded-4 border mb-4" style="background:#fff7e1;">
                <small class="text-muted d-block mb-1">Dirección de envío</small>
                <div class="d-flex align-items-center">
                    <i class="bi bi-geo-alt me-2 text-warning"></i>
                    <span class="fw-semibold">
                        {{ $pedido->direccion?->direccion ?? 'Dirección no especificada' }}
                    </span>
                </div>
            </div>

            {{-- BOTONES INFERIORES --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('perfil.pedido.boleta', $pedido->id) }}"
                   class="btn btn-outline-success rounded-pill px-4">
                    <i class="bi bi-download me-1"></i> Descargar boleta
                </a>

                <a href="{{ route('perfil.pedidos') }}"
                   class="btn btn-success rounded-pill px-4">
                    Cerrar
                </a>
            </div>

        </div>
    </div>

</div>
@endsection


</body>
</html>