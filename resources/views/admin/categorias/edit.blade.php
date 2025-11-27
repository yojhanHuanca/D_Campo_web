<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Admin</title>
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
            <h1 class="h3 fw-bold text-dark mb-1">Editar Categoría</h1>
            <p class="text-muted">Modificar categoría existente</p>
        </div>
        <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>

    <!-- Alertas de Error -->
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <h6 class="mb-0 fw-bold">Errores de validación</h6>
            </div>
            <hr>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" id="categoriaForm">
                @csrf
                @method('PUT')

                <!-- Campo Nombre -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-tag text-primary"></i>
                        </span>
                        <input type="text" name="nombre" class="form-control" 
                               value="{{ old('nombre', $categoria->nombre) }}" 
                               placeholder="Ingrese el nombre de la categoría" 
                               required
                               oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>

                <!-- Campo Descripción -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light align-items-start">
                            <i class="bi bi-text-paragraph text-primary"></i>
                        </span>
                        <textarea name="descripcion" class="form-control" rows="3" 
                                  placeholder="Descripción opcional de la categoría">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    </div>
                </div>

                <!-- Campo Activo - CORREGIDO -->
                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1"
                               {{ old('activo', $categoria->activo) ? 'checked' : '' }}>
                        <input type="hidden" name="activo" value="0">
                        <label class="form-check-label fw-semibold" for="activo">
                            <i class="bi bi-power me-1"></i> Categoría Activa
                        </label>
                    </div>
                    <div class="form-text text-muted small">
                        Cuando está activa, la categoría estará disponible para usar en productos.
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-arrow-clockwise me-2"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('categoriaForm');
    const checkbox = document.querySelector('input[type="checkbox"][name="activo"]');
    const hiddenInput = document.querySelector('input[type="hidden"][name="activo"]');
    
    // Manejar el cambio del checkbox
    checkbox.addEventListener('change', function() {
        hiddenInput.value = this.checked ? '1' : '0';
    });
    
    // Configurar valor inicial
    hiddenInput.value = checkbox.checked ? '1' : '0';
});
</script>
@endsection
</body>
</html>