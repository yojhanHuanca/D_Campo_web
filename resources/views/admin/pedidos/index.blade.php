<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedi admin</title>
</head>
<body>
    @extends('admin.layout')

    @section('content')
    <div class="container-fluid py-3">
    
        {{-- TÍTULO --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Gestión de Pedidos</h4>
                <small class="text-muted">Administra y actualiza el estado de los pedidos</small>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    
        {{-- BUSCADOR + FILTRO --}}
        <form method="GET" action="{{ route('admin.pedidos.index') }}" class="row g-2 mb-3">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           name="q"
                           class="form-control border-start-0"
                           placeholder="Buscar por código o ID de pedido..."
                           value="{{ $busqueda }}">
                </div>
            </div>
    
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-funnel text-muted"></i>
                    </span>
                    <select name="estado" class="form-select" onchange="this.form.submit()">
                        <option value="todos" {{ $estadoFiltro === 'todos' || !$estadoFiltro ? 'selected' : '' }}>Todos los estados</option>
                        <option value="pendiente"  {{ $estadoFiltro === 'pendiente'  ? 'selected' : '' }}>Pendientes</option>
                        <option value="pagado"     {{ $estadoFiltro === 'pagado'     ? 'selected' : '' }}>Empaquetados (Pagados)</option>
                        <option value="enviado"    {{ $estadoFiltro === 'enviado'    ? 'selected' : '' }}>En tránsito</option>
                        <option value="entregado"  {{ $estadoFiltro === 'entregado'  ? 'selected' : '' }}>Entregados</option>
                        <option value="cancelado"  {{ $estadoFiltro === 'cancelado'  ? 'selected' : '' }}>Cancelados</option>
                    </select>
                </div>
            </div>
        </form>
    
        {{-- CARDS RESUMEN --}}
        <div class="row g-3 mb-3">
            <div class="col-md-2">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <p class="text-muted small mb-1">Total</p>
                        <h5 class="fw-bold mb-0">{{ $totalPedidos }}</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-md-2">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <p class="text-muted small mb-1">Pendientes</p>
                        <h5 class="fw-bold mb-0 text-warning">{{ $pendientes }}</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-md-2">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <p class="text-muted small mb-1">Empaquetados</p>
                        <h5 class="fw-bold mb-0 text-info">{{ $empaquetados }}</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-md-2">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <p class="text-muted small mb-1">En tránsito</p>
                        <h5 class="fw-bold mb-0 text-primary">{{ $enTransito }}</h5>
                    </div>
                </div>
            </div>
    
            <div class="col-md-2">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body py-3">
                        <p class="text-muted small mb-1">Entregados</p>
                        <h5 class="fw-bold mb-0 text-success">{{ $entregados }}</h5>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- LISTA DE PEDIDOS (CON SCROLL SOLO AQUÍ) --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
    
                <div style="max-height: 430px; overflow-y: auto;">
    
                    @forelse($pedidos as $pedido)
                        <div class="border-bottom px-3 py-3">
    
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="fw-bold me-2">DC-{{ $pedido->id }}</span>
    
                                        {{-- Badge de estado --}}
                                        @php
                                            $badgeClass = 'secondary';
                                            if ($pedido->estado === 'pendiente')  $badgeClass = 'warning';
                                            if ($pedido->estado === 'pagado')     $badgeClass = 'info';
                                            if ($pedido->estado === 'enviado')    $badgeClass = 'primary';
                                            if ($pedido->estado === 'entregado')  $badgeClass = 'success';
                                            if ($pedido->estado === 'cancelado')  $badgeClass = 'danger';
                                        @endphp
    
                                        <span class="badge bg-{{ $badgeClass }} text-dark small">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </div>
    
                                    <small class="text-muted">
                                        {{ $pedido->created_at->format('d \d\e F \d\e\l Y, h:i a') }}
                                        @if($pedido->usuario)
                                            • {{ $pedido->usuario->name }}
                                        @endif
                                    </small>
    
                                    {{-- Lista corta de productos --}}
                                    <div class="mt-2 small">
                                        @foreach($pedido->items as $item)
                                            <div class="d-flex align-items-center mb-1">
                                                {{-- Imagen si la tienes en producto --}}
                                                @if($item->producto && $item->producto->imagen)
                                                    <img src="{{ asset('storage/'.$item->producto->imagen) }}"
                                                         alt="{{ $item->producto->nombre }}"
                                                         class="me-2 rounded"
                                                         style="width:40px;height:40px;object-fit:cover;">
                                                @endif
                                                <span>
                                                    {{ $item->producto->nombre ?? 'Producto eliminado' }}
                                                    <span class="text-muted">× {{ $item->cantidad }}</span>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
    
                                <div class="text-end">
                                    <p class="mb-1 text-muted small">Total del pedido</p>
                                    <h5 class="fw-bold mb-2">S/ {{ number_format($pedido->total, 2) }}</h5>
    
                                    {{-- Botón Ver detalles (luego lo conectamos a una vista admin.show) --}}
                                    <a href="{{ route('admin.pedidos.show', $pedido->id) }}"
                                       class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <i class="bi bi-eye me-1"></i> Ver detalles
                                    </a>
                                </div>
                            </div>
    
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            No hay pedidos registrados.
                        </div>
                    @endforelse
    
                </div>
    
            </div>
        </div>
    
    </div>
    @endsection

</body>
</html>
