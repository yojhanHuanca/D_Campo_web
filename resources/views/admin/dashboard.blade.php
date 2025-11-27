<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panel de contol</title>
</head>
<body>
    @extends('admin.layout')

@section('content')

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container-fluid">
    
    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-1">Dashboard</h2>
            <p class="text-muted mb-0">Resumen general de tu tienda D'Campo</p>
        </div>
    </div>

    <!-- ESTADÍSTICAS PRINCIPALES - Fila 1 -->
    <div class="row g-4 mb-4">
        
        <!-- Total Productos -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Total Productos</p>
                            <h3 class="fw-bold mb-0">{{ $totalProductos }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="bi bi-box-seam text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-sm btn-outline-primary mt-3 w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i> Ver productos
                    </a>
                </div>
            </div>
        </div>

        <!-- Pedidos Totales -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Pedidos Totales</p>
                            <h3 class="fw-bold mb-0">{{ ($totalPedidos) }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-cart-check text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-sm btn-outline-success mt-3 w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i> Ver pedidos
                    </a>
                </div>
            </div>
        </div>

        <!-- Pedidos Pendientes -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Pedidos Pendientes</p>
                            <h3 class="fw-bold mb-0">{{ $pedidosRecientes->count() }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-clock-history text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-warning mt-3 w-100">
                        <i class="bi bi-gear me-1"></i> Gestionar
                    </a>
                </div>
            </div>
        </div>

        <!-- Reseñas Reportadas -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Reseñas Reportadas</p>
                            <h3 class="fw-bold mb-0">{{ $reportadas }}</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded p-3">
                            <i class="bi bi-exclamation-triangle text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-danger mt-3 w-100">
                        <i class="bi bi-eye me-1"></i> Revisar
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ESTADÍSTICAS SECUNDARIAS - Fila 2 -->
    <div class="row g-4 mb-4">
        
        <!-- Cupones Activos -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Cupones Activos</p>
                            <h3 class="fw-bold mb-0">3</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="bi bi-ticket-perforated text-info" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-info mt-3 w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i> Ver cupones
                    </a>
                </div>
            </div>
        </div>

        <!-- Ingresos Totales -->
             <div class="col-lg-4">
                 <div class="card border-0 shadow-sm h-100 rounded-4">
                     <div class="card-body">
             
                         <div class="d-flex justify-content-between align-items-start">
                             
                             <div>
                                 <p class="text-muted mb-2 small text-uppercase fw-semibold">Ingresos Totales</p>
                                 <h3 class="fw-bold mb-0">S/ {{ number_format($ingresosTotales, 2) }}</h3>
                             </div>
             
                             <div class="bg-success bg-opacity-10 rounded p-3">
                                 <i class="bi bi-currency-dollar text-success" style="font-size: 1.7rem;"></i>
                             </div>
             
                         </div>
             
                         <a href="#" class="btn btn-sm btn-outline-success mt-3 w-100 rounded-pill">
                             <i class="bi bi-graph-up me-1"></i> Ver reporte
                         </a>
             
                     </div>
                 </div>
             </div>
             

        <!-- Total Reseñas -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Total Reseñas</p>
                            <h3 class="fw-bold mb-0">{{ $total }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-star-fill text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="¨" class="btn btn-sm btn-outline-warning mt-3 w-100">
                        <i class="bi bi-chat-dots me-1"></i> Ver reseñas
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLAS -->
    <div class="row g-4">
        
        <!-- Pedidos Recientes -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-cart-check text-primary me-2"></i>Pedidos Recientes
                        </h5>
                        <span class="badge bg-primary">
                        {{ ($totalPedidos) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">

                @forelse($pedidosRecientes as $p)
            
                    <div class="d-flex justify-content-between align-items-center 
                                bg-light bg-opacity-25 border rounded-3 px-3 py-3 mb-2">
            
                        <div>
                            <p class="fw-semibold mb-1">{{ $p->codigo_seguimiento }}</p>
                            <small class="text-muted">{{ $p->created_at->format('d/m/Y') }}</small>
                        </div>
                        <div class="text-end">

                            <p class="fw-semibold mb-1">
                                S/ {{ number_format($p->total, 2) }}
                            </p>
                            @php
                                $color = [
                                    'pendiente' => 'warning',
                                    'pagado' => 'success',
                                    'entregado' => 'primary',
                                    'cancelado' => 'danger',
                                ][$p->estado] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} bg-opacity-25 text-{{ $color }} small px-2 py-1">
                                {{ $p->estado }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                        <span>No hay pedidos recientes</span>
                    </div>
                @endforelse
                </div>
            </div>
        </div>

        <!-- Reseñas Recientes -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-star text-warning me-2"></i>Reseñas Recientes
                        </h5>
                        <span class="badge bg-warning">
                         {{ $reseñasRecientes->count() }}
                        </span>
                        
                    </div>
                </div>

                  <!-- LISTA -->
                       <div class="list-group">
               
                           @forelse($reseñasRecientes as $r)
               
                               <div class="list-group-item py-3">
               
                                   <div class="d-flex justify-content-between">
               
                                       <!-- IZQUIERDA: nombre y comentario -->
                                       <div>
                                           <p class="fw-semibold mb-1">{{ $r->usuario->name }}</p>
               
                                           <p class="text-muted small mb-1" style="max-width: 95%;">
                                               {{ $r->comentario }}
                                           </p>
               
                                           @if($r->estado === 'reportada')
                                               <span class="badge bg-danger-subtle text-danger border border-danger small">
                                                   Reportada
                                               </span>
                                           @endif
                                       </div>
               
                                       <!-- DERECHA: estrellitas -->
                                       <div class="text-warning fs-6" style="white-space: nowrap;">
                                           @for($i = 1; $i <= 5; $i++)
                                               @if($i <= $r->puntuacion)
                                                   ★
                                               @else
                                                   ☆
                                               @endif
                                           @endfor
                                       </div>
               
                                   </div>
               
                               </div>
               
                           @empty
               
                               <p class="text-muted text-center py-3">
                                   No hay reseñas recientes
                               </p>
               
                           @endforelse
               
                       </div>
               
                   </div>
               </div>
                               
            </div>
        </div>

    </div>

</div>

@endsection
</body>
</html>