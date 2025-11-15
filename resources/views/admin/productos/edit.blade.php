<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar </title>
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                            <i class="bi bi-house-door"></i> Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.productos.index') }}" class="text-decoration-none">Productos</a>
                    </li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square text-primary me-2"></i>Editar Producto
            </h2>
            <p class="text-muted">Modifica la información del producto</p>
        </div>
    </div>

    <!-- Errores -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-start">
                <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>¡Atención!</strong> Corrige los siguientes errores:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Formulario -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-info-circle text-primary me-2"></i>Información del Producto
                    </h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-tag me-2 text-primary"></i>Nombre del producto
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nombre" class="form-control form-control-lg" 
                                   value="{{ $producto->nombre }}" 
                                   placeholder="Ej: Papas frescas orgánicas" 
                                   required>
                        </div>

                        <!-- Precio y Stock -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-currency-dollar me-2 text-success"></i>Precio (S/)
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">S/</span>
                                    <input type="number" name="precio" class="form-control" 
                                           step="0.01" min="0" 
                                           value="{{ $producto->precio }}" 
                                           placeholder="0.00" 
                                           required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-box-seam me-2 text-info"></i>Stock disponible
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <input type="number" name="stock" class="form-control" 
                                           min="0" 
                                           value="{{ $producto->stock }}" 
                                           placeholder="0" 
                                           required>
                                    <span class="input-group-text">unidades</span>
                                </div>
                            </div>
                        </div>

                        <!-- Categoría -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-grid me-2 text-warning"></i>Categoría
                            </label>
                            <select name="categoria_id" class="form-select form-select-lg">
                                <option value="">Sin categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Descripción corta -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-text-left me-2 text-secondary"></i>Descripción corta
                            </label>
                            <textarea name="descripcion_corta" class="form-control" rows="4" 
                                      placeholder="Escribe una breve descripción del producto...">{{ $producto->descripcion_corta }}</textarea>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Esta descripción aparecerá en el listado de productos
                            </small>
                        </div>

                        <!-- Imagen del Producto -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-image me-2 text-primary"></i>Imagen del producto
                            </label>
                            
                            <!-- Vista previa imagen actual -->
                            @if($producto->imagen)
                                <div class="mb-3 p-3 bg-light rounded text-center">
                                    <p class="text-muted small mb-2">Imagen actual:</p>
                                    <img src="{{ asset('storage/'.$producto->imagen) }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 200px; object-fit: cover;" 
                                         alt="{{ $producto->nombre }}">
                                </div>
                            @endif

                            <!-- Input para cambiar imagen -->
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Formatos: JPG, PNG (Máx. 2MB). Deja vacío si no deseas cambiar la imagen.
                            </small>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Actualizar Producto
                            </button>
                            <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Sidebar - Información adicional -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-info-circle text-primary me-2"></i>Información
                    </h5>
                </div>
                <div class="card-body p-4">
                    
                    <div class="alert alert-info border-0 mb-3">
                        <i class="bi bi-lightbulb me-2"></i>
                        <small><strong>Consejo:</strong> Usa imágenes de alta calidad para mejor presentación del producto.</small>
                    </div>

                    <div class="alert alert-warning border-0 mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <small><strong>Importante:</strong> Los campos marcados con <span class="text-danger">*</span> son obligatorios.</small>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
</body>
</html>