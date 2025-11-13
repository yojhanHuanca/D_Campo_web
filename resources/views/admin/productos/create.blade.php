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
    <h2 class="fw-bold mb-4">Nuevo Producto</h2>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hay errores:</strong>
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

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label class="form-label">Precio (S/)</label>
            <input type="number" name="precio" step="0.01" min="0" class="form-control"
                   value="{{ old('precio') }}" required>
        </div>

        {{-- Stock --}}
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" min="0" class="form-control"
                   value="{{ old('stock', 0) }}" required>
        </div>

        {{-- Categoría --}}
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                <option value="">Sin categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Descripción corta --}}
        <div class="mb-3">
            <label class="form-label">Descripción corta</label>
            <textarea name="descripcion_corta" class="form-control" rows="3">{{ old('descripcion_corta') }}</textarea>
        </div>

        {{-- Imagen --}}
        <div class="mb-3">
            <label class="form-label">Imagen del producto</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
            <small class="text-muted">Formatos permitidos: JPG, JPEG, PNG, WEBP. Máx: 2MB</small>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

</body>
</html>