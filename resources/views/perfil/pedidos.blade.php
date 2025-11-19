<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
  @extends('layouts.perfil')

@section('content')
<div class="container py-3">
    <div class="row g-3">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            @include('perfil.sidebar')
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="col-md-9">

            {{-- Encabezado --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold mb-1">Mis Pedidos 📦</h4>
                    <p class="text-muted small mb-0">Historial completo de tus compras</p>
                </div>
                <span class="badge bg-white text-success border border-success rounded-pill px-3 py-2">
                    {{ $pedidos->count() }} total
                </span>
            </div>

            {{-- LISTADO DE PEDIDOS --}}
            @forelse ($pedidos as $pedido)

                <div class="card border-0 shadow-sm rounded-4 mb-3">

                    {{-- Línea Naranja Superior --}}
                    <div class="bg-warning" style="height: 6px; border-radius: 16px 16px 0 0;"></div>

                    <div class="card-body p-3">

                        {{-- Cabecera del Pedido --}}
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Pedido #DC-{{ $pedido->id }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $pedido->created_at->format('d \d\e F \d\e\l Y, h:i a') }}
                                </small>
                            </div>

                            {{-- Badge de Estado --}}
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1">
                                <i class="bi bi-hourglass-split me-1"></i>
                                {{ ucfirst($pedido->estado) }}
                            </span>
                        </div>

                        {{-- Lista de Productos --}}
                        @foreach ($pedido->items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                
                                <div class="d-flex align-items-center gap-2">
                                    @if($item->producto->imagen)
                                        <img src="{{ asset('storage/' . $item->producto->imagen) }}" 
                                             alt="{{ $item->producto->nombre }}"
                                             class="rounded-3 object-fit-cover"
                                             style="width: 60px; height: 60px;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <h6 class="fw-semibold mb-0 small">{{ $item->producto->nombre }}</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            Cantidad: {{ $item->cantidad }} × S/ {{ number_format($item->precio, 2) }}
                                        </small>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-0 text-success">
                                    S/ {{ number_format($item->cantidad * $item->precio, 2) }}
                                </h6>
                            </div>
                        @endforeach

                        {{-- Código de Seguimiento --}}
                        <div class="bg-light rounded-3 p-2 mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-box-seam text-success me-1"></i>
                                Código de seguimiento:
                            </small>
                            <span class="fw-bold text-success small">{{ $pedido->codigo_seguimiento }}</span>
                        </div>

                        {{-- Total y Botones --}}
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-muted d-block">Total del pedido</small>
                                <h5 class="fw-bold text-success mb-0">S/ {{ number_format($pedido->total, 2) }}</h5>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('perfil.pedido.boleta', $pedido->id) }}" class="btn btn-outline-success btn-sm rounded-pill">
                                    <i class="bi bi-download me-1"></i>
                                    Descargar boleta
                                </a>

                                <a href="{{ route('perfil.pedido.detalle', $pedido->id) }}"
                                   class="btn btn-success btn-sm rounded-pill">
                                    <i class="bi bi-eye me-1"></i>
                                    Ver detalles
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            @empty
                {{-- Estado Vacío --}}
                <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                    <div class="mb-3">
                        <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-2">No tienes pedidos aún</h5>
                    <p class="text-muted mb-4">Descubre nuestros productos naturales a base de palta</p>
                    <a href="{{ route('store.index') }}" class="btn btn-success btn-lg rounded-pill px-5">
                        <i class="bi bi-shop me-2"></i>
                        Explorar tienda
                    </a>
                </div>
            @endforelse

            {{-- Mensaje de Agradecimiento --}}
            <div class="card border-0 shadow-sm rounded-4 mt-3" style="background:#ecf4eb;">
                <div class="card-body p-3">
                    <p class="text-center text-muted mb-0 small">
                        <i class="bi bi-leaf"></i> <i class="bi bi-emoji-smile"></i> <i class="bi bi-leaf"></i><br>
                        <strong>Gracias por confiar en la belleza natural de D'Campo</strong> 💚<br>
                        Tu bienestar es nuestra prioridad • Productos 100% naturales
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

</body>
</html>