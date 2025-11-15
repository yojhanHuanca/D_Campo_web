<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2 class="fw-bold mb-1">Gestión de Productos</h2>
            <p class="text-muted mb-0">Administra el catálogo de productos de D'Campo.</p>
        </div>
    </div>

    <!-- Barra Superior -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('admin.productos.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Producto
            </a>
        </div>
    </div>

    <!-- Barra de Búsqueda y Filtro -->
    <form action="{{ route('admin.productos.index') }}" method="GET">
        <div class="row g-3 mb-4">
            <!-- Buscador -->
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="buscar" class="form-control" 
                           placeholder="Buscar productos..." 
                           value="{{ request('buscar') }}">
                </div>
            </div>

            <!-- Filtro de Categoría -->
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-funnel"></i>
                    </span>
                    <select name="categoria" class="form-select" onchange="this.form.submit()">
                        <option value="todas">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ (isset($categoriaId) && $categoriaId == $categoria->id) ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>

    <!-- Lista de Productos con Scroll -->
    <div class="row">
        <div class="col-12" style="max-height: 65vh; overflow-y: auto;">
            
            @foreach ($productos as $producto)
                <div class="card mb-3 shadow-sm border">
                    <div class="card-body">
                        <div class="row align-items-center">
                            
                            <!-- Imagen del Producto -->
                            <div class="col-auto">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/'.$producto->imagen) }}" 
                                         class="rounded" 
                                         style="width: 90px; height: 90px; object-fit: cover;" 
                                         alt="{{ $producto->nombre }}">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                                         style="width: 90px; height: 90px;">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Información del Producto -->
                            <div class="col">
                                <h5 class="mb-2 fw-bold">{{ $producto->nombre }}</h5>
                                <p class="mb-2 text-secondary">{{ $producto->descripcion_corta }}</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <span class="badge bg-primary">
                                        <i class="bi bi-currency-dollar me-1"></i>S/ {{ number_format($producto->precio, 2) }}
                                    </span>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-tag me-1"></i>{{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                    </span>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-box-seam me-1"></i>Stock: {{ $producto->stock }}
                                    </span>
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="col-auto">
                                <div class="d-flex gap-2">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('admin.productos.edit', $producto->id) }}" 
                                       class="btn btn-outline-primary rounded-circle" 
                                       style="width: 40px; height: 40px; padding: 0;" 
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger rounded-circle" 
                                                style="width: 40px; height: 40px; padding: 0;" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar producto?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
</body>
</html>