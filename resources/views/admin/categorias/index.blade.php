<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    @extends('admin.layout')

@section('content')
    <h2 class="fw-bold mb-4">Gestión de Categorías</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary btn-sm">
            + Nueva Categoría
        </a>
    </div>

    @if($categorias->isEmpty())
        <p>No hay categorías registradas.</p>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Activo</th>
                    <th>Creada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>{{ $categoria->activo ? 'Sí' : 'No' }}</td>
                        <td>{{ $categoria->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

</body>
</html>