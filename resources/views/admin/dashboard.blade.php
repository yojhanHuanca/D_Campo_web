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
                            <h3 class="fw-bold mb-0">0</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-cart-check text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3 w-100">
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
                            <h3 class="fw-bold mb-0">0</h3>
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
                            <h3 class="fw-bold mb-0">2</h3>
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
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-2 small text-uppercase fw-semibold">Ingresos Totales</p>
                            <h3 class="fw-bold mb-0">S/ 0.00</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="bi bi-currency-dollar text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-success mt-3 w-100">
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
                            <h3 class="fw-bold mb-0">5</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="bi bi-star-fill text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-warning mt-3 w-100">
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
                        <span class="badge bg-primary">0</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">Cliente</th>
                                    <th class="py-3">Total</th>
                                    <th class="py-3">Estado</th>
                                    <th class="py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                                        <span>No hay pedidos recientes</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                        <span class="badge bg-warning">5</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">ID</th>
                                    <th class="py-3">Producto</th>
                                    <th class="py-3">Usuario</th>
                                    <th class="py-3">Valoración</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-chat-dots d-block mb-2" style="font-size: 2rem;"></i>
                                        <span>No hay reseñas recientes</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
</body>
</html>