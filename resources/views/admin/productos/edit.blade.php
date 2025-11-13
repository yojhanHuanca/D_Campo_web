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
    <h2 class="fw-bold mb-4">Editar Producto</h2>

    {{-- Errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los siguientes errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label class="form-label">Nombre del producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label class="form-label">Precio (S/)</label>
            <input type="number" name="precio" class="form-control" step="0.01" min="0"
                   value="{{ $producto->precio }}" required>
        </div>

        {{-- Stock --}}
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" min="0"
                   value="{{ $producto->stock }}" required>
        </div>

        {{-- Categoría --}}
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                <option value="">Sin categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Descripción corta --}}
        <div class="mb-3">
            <label class="form-label">Descripción corta</label>
            <textarea name="descripcion_corta" class="form-control" rows="3">{{ $producto->descripcion_corta }}</textarea>
        </div>

        {{-- Imagen actual --}}
        @if($producto->imagen)
            <div class="mb-3">
                <label class="form-label">Imagen actual:</label><br>
                <img src="{{ asset('storage/'.$producto->imagen) }}" width="120" class="rounded">
            </div>
        @endif

        {{-- Imagen nueva --}}
        <div class="mb-3">
            <label class="form-label">Cambiar imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

</body>
</html>