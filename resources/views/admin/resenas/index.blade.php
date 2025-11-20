<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
</head>
<body>
    
@extends('admin.layout')

@section('content')

<div class="container-fluid py-4">

    {{-- TÍTULO --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Gestión de Reseñas</h4>
        <p class="text-muted small mb-0">Administra las reseñas de clientes, aprueba o elimina contenido</p>
    </div>

    {{-- BUSCADOR --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           name="q" 
                           class="form-control border-start-0"
                           placeholder="Buscar por producto, usuario o comentario..."
                           value="{{ $busqueda }}">
                </div>
            </form>
        </div>
    </div>

    {{-- ESTADÍSTICAS --}}
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-2">Total</p>
                    <h4 class="fw-bold mb-0">{{ $total }}</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-2">Reportadas</p>
                    <h4 class="fw-bold text-danger mb-0">{{ $reportadas }}</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-2">Aprobadas</p>
                    <h4 class="fw-bold text-success mb-0">{{ $aprobadas }}</h4>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-2">Promedio</p>
                    <h4 class="fw-bold text-warning mb-0">{{ number_format($promedio, 1) }} ⭐</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">Todas ({{ $total }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Reportadas ({{ $reportadas }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Aprobadas ({{ $aprobadas }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Pendientes (1)</a>
        </li>
    </ul>

    {{-- LISTADO CON SCROLL --}}
    <div style="max-height: 500px; overflow-y: auto;">

        @foreach ($resenas as $resena)
            <div class="card border shadow-sm mb-3">
                <div class="card-body p-4">

                    {{-- HEADER: Usuario, estrellas y badge --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h6 class="fw-bold mb-0">{{ $resena->usuario->name }}</h6>
                                <span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if($i <= $resena->calificacion)
                                            <span class="text-warning">★</span>
                                        @else
                                            <span class="text-muted">☆</span>
                                        @endif
                                    @endfor
                                </span>
                            </div>

                            <p class="text-muted small mb-0">
                                <strong>Producto:</strong> {{ $resena->producto->nombre }}
                            </p>
                            <p class="text-muted small mb-0">
                                {{ $resena->created_at->locale('es')->translatedFormat('d \d\e F \d\e Y') }}
                            </p>
                        </div>

                        {{-- Badge de estado --}}
                        @if($resena->estado === 'aprobada')
                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>Aprobada
                            </span>
                        @elseif($resena->estado === 'reportada')
                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-2">
                                <i class="bi bi-exclamation-triangle me-1"></i>Reportada
                            </span>
                        @endif
                    </div>

                    {{-- Comentario --}}
                    <p class="mb-3 text-dark">{{ $resena->comentario }}</p>

                    {{-- Motivo de reporte --}}
                    @if($resena->estado === 'reportada' && $resena->motivo_reporte)
                        <div class="alert alert-danger border-danger d-flex align-items-start py-2 mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger me-2 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Motivo del reporte:</strong>
                                <small>{{ $resena->motivo_reporte }}</small>
                            </div>
                        </div>
                    @endif

                    {{-- BOTONES --}}
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">

                        {{-- Ver detalles --}}
                        <a href="{{ route('admin.resenas.show', $resena->id) }}"
                           class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                            <i class="bi bi-eye"></i>
                            <span>Ver detalles</span>
                        </a>

                        <div class="d-flex gap-2">

                            {{-- Aprobar --}}
                            @if($resena->estado === 'reportada')
                                <form action="{{ route('admin.resenas.aprobar', $resena->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                        <i class="bi bi-check-circle"></i>
                                        <span>Aprobar</span>
                                    </button>
                                </form>
                            @endif

                            {{-- Eliminar --}}
                            <form action="{{ route('admin.resenas.eliminar', $resena->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta reseña?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                    <i class="bi bi-trash"></i>
                                    <span>Eliminar</span>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        @endforeach

    </div>

</div>

@endsection
</body>
</html>