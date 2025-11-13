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
    <h2 class="fw-bold mb-3">Gestión de Productos</h2>
    <p>Administra el catálogo de productos de D'Campo.</p>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <form class="w-50">
            <input type="text" class="form-control" placeholder="Buscar productos...">
        </form>

        <a href="{{ route('admin.productos.create') }}" class="btn btn-success btn-sm">+ Nuevo Producto</a>

    </div>

    @if($productos->isEmpty())
        <p>No hay productos registrados.</p>
    @else
        @foreach($productos as $producto)
            <div class="card mb-3">
                <div class="card-body d-flex">

                    {{-- Imagen --}}
                    @if($producto->imagen)
                        <img src="{{ asset('storage/'.$producto->imagen) }}" width="80" height="80" class="rounded me-3" alt="Imagen">
                    @else
                        <div class="bg-light border me-3 d-flex align-items-center justify-content-center"
                             style="width:80px; height:80px;">
                            <span class="text-muted">Sin imagen</span>
                        </div>
                    @endif

                    {{-- Info principal --}}
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $producto->nombre }}</h5>
                        <p class="mb-1 text-muted">
                            S/ {{ number_format($producto->precio, 2) }}
                            · Categoría: {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                            · Stock: {{ $producto->stock }}
                        </p>
                        @if($producto->descripcion_corta)
                            <small class="text-muted">{{ $producto->descripcion_corta }}</small>
                        @endif
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-outline-primary btn-sm me-2">
                            Editar
                        </a>
                        
                        <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection

</body>
</html>