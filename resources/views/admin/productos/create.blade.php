<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
</head>
<body>
    @extends('admin.layout')

@section('content')
<div class="container">

    {{-- Título --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">➕ Nuevo Producto</h2>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Volver a Productos
        </a>
    </div>

    {{-- Card principal --}}
    <div class="card shadow-sm">
        <div class="card-body p-4">

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Revisa estos errores:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- Nombre --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control shadow-sm" value="{{ old('nombre') }}" required>
                    </div>

                    {{-- Precio --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Precio (S/)</label>
                        <input type="number" name="precio" step="0.01" min="0" class="form-control shadow-sm"
                               value="{{ old('precio') }}" required>
                    </div>

                    {{-- Stock --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Stock</label>
                        <input type="number" name="stock" min="0" class="form-control shadow-sm"
                               value="{{ old('stock', 0) }}" required>
                    </div>

                    {{-- Categoría --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Categoría</label>
                        <select name="categoria_id" class="form-select shadow-sm">
                            <option value="">Sin categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" 
                                    {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Imagen --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Imagen del producto</label>
                        <input type="file" name="imagen" class="form-control shadow-sm" accept="image/*">
                        <small class="text-muted">Formatos: JPG, JPEG, PNG, WEBP (máx. 2MB)</small>
                    </div>

                    {{-- Descripción corta --}}
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Descripción corta</label>
                        <textarea name="descripcion_corta" class="form-control shadow-sm" rows="3">{{ old('descripcion_corta') }}</textarea>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary me-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        Guardar Producto
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection


</body>
</html>