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

    <h1 class="fw-bold mb-4">Dashboard</h1>

    {{-- PRIMERA FILA --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Productos</h5>
                    <h2 class="fw-bold">8</h2>
                    <a href="#" class="btn btn-success btn-sm mt-3">Ver más</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Totales</h5>
                    <h2 class="fw-bold">0</h2>
                    <a href="#" class="btn btn-success btn-sm mt-3">Ver pedidos</a>
                </div>
            </div>
        </div>

    </div>

    {{-- SEGUNDA FILA --}}
    <div class="row g-4 mt-2">

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <h2 class="fw-bold">0</h2>
                    <a href="#" class="btn btn-warning btn-sm mt-3">Gestionar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Reseñas Reportadas</h5>
                    <h2 class="fw-bold">2</h2>
                    <a href="#" class="btn btn-danger btn-sm mt-3">Revisar</a>
                </div>
            </div>
        </div>

    </div>

    {{-- TERCERA FILA DE CARDS --}}
    <div class="row g-4 mt-2">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Cupones Activos</h5>
                    <h2 class="fw-bold">3</h2>
                    <a href="#" class="btn btn-primary btn-sm mt-3">Ver cupones</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Ingresos Totales</h5>
                    <h2 class="fw-bold">S/0.00</h2>
                    <a href="#" class="btn btn-secondary btn-sm mt-3">Ver reporte</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Reseñas</h5>
                    <h2 class="fw-bold">5</h2>
                    <a href="#" class="btn btn-info btn-sm mt-3">Ver reseñas</a>
                </div>
            </div>
        </div>

    </div>

    {{-- TABLA DE PEDIDOS --}}
    <div class="mt-5">
        <h3 class="fw-bold mb-3">Pedidos Recientes</h3>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- TABLA DE RESEÑAS --}}
    <div class="mt-5">
        <h3 class="fw-bold mb-3">Reseñas Recientes</h3>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-warning">
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th>Comentario</th>
                            <th>Valoración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                            <td>—</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

</body>
</html>