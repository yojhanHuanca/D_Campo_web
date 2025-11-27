<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    @extends('admin.layout')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Gestión de Categorías</h1>
            <p class="text-muted">Administra las categorías de productos</p>
        </div>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Nueva Categoría
        </a>
    </div>

    <!-- Alertas -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabla de Categorías -->
    @if($categorias->isEmpty())
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                <h5 class="text-muted mt-3">No hay categorías registradas</h5>
                <p class="text-muted">Comienza creando tu primera categoría</p>
                <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Crear Categoría
                </a>
            </div>
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Activo</th>
                                <th>Creada</th>
                                <th class="text-center pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td class="ps-4 fw-semibold text-muted">#{{ $categoria->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-tag text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $categoria->nombre }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($categoria->descripcion)
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;" 
                                                  title="{{ $categoria->descripcion }}">
                                                {{ $categoria->descripcion }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Sin descripción</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($categoria->activo)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>Sí
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-x-circle me-1"></i>No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">
                                        {{ $categoria->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" 
                                               class="btn btn-outline-warning" 
                                               title="Editar categoría">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')"
                                                        title="Eliminar categoría">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.table td {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

.btn-group .btn {
    border-radius: 0.375rem !important;
    margin: 0 2px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.card {
    border: 1px solid #e3e6f0;
}
</style>
@endsection
</body>
</html>