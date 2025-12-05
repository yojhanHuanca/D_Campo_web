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

    {{-- ENCABEZADO --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            <i class="bi bi-star-fill text-warning me-2"></i>
            Gestión de Reseñas
        </h4>
        <p class="text-muted small mb-0">Administra las reseñas de clientes, aprueba o elimina contenido</p>
    </div>

    {{-- BUSCADOR --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.resenas.index') }}">
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           name="q" 
                           class="form-control border-0"
                           placeholder="Buscar por producto, usuario o comentario..."
                           value="{{ $busqueda ?? '' }}">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-search me-1"></i>Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ESTADÍSTICAS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Reseñas</p>
                            <h4 class="fw-bold mb-0">{{ $total }}</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-chat-left-text-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-danger small mb-1">Reportadas</p>
                            <h4 class="fw-bold text-danger mb-0">{{ $reportadas }}</h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-success small mb-1">Aprobadas</p>
                            <h4 class="fw-bold text-success mb-0">{{ $aprobadas }}</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-warning small mb-1">Promedio</p>
                            <h4 class="fw-bold mb-0">
                                {{ number_format($promedio, 1) }}
                                <i class="bi bi-star-fill text-warning fs-6"></i>
                            </h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-star-half text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABS --}}
    <ul class="nav nav-pills mb-4 gap-2">
        <li class="nav-item">
            <a class="nav-link {{ !$estado ? 'active' : '' }}"
               href="{{ route('admin.resenas.index') }}">
                <i class="bi bi-list-ul me-1"></i>
                Todas <span class="badge bg-white text-primary ms-1">{{ $total }}</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{ $estado === 'reportada' ? 'active' : '' }}"
               href="{{ route('admin.resenas.index', ['estado' => 'reportada']) }}">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Reportadas <span class="badge bg-white text-danger ms-1">{{ $reportadas }}</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{ $estado === 'aprobada' ? 'active' : '' }}"
               href="{{ route('admin.resenas.index', ['estado' => 'aprobada']) }}">
                <i class="bi bi-check-circle me-1"></i>
                Aprobadas <span class="badge bg-white text-success ms-1">{{ $aprobadas }}</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link {{ $estado === 'pendiente' ? 'active' : '' }}"
               href="{{ route('admin.resenas.index', ['estado' => 'pendiente']) }}">
                <i class="bi bi-hourglass-split me-1"></i>
                Pendientes <span class="badge bg-white text-warning ms-1">{{ $pendientes }}</span>
            </a>
        </li>
    </ul>

    {{-- LISTADO CON SCROLL --}}
    <div class="overflow-auto" style="max-height: 600px;">

        @forelse ($resenas as $resena)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">

                    {{-- HEADER --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            
                            {{-- Usuario y Avatar --}}
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-success">{{ strtoupper(substr($resena->usuario->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $resena->usuario->name }}</h6>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $resena->created_at->locale('es')->translatedFormat('d \d\e F \d\e Y') }}
                                    </small>
                                </div>
                            </div>

                            {{-- Producto --}}
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="bi bi-box-seam text-success"></i>
                                <small class="text-muted">
                                    <strong>Producto:</strong> {{ $resena->producto->nombre }}
                                </small>
                            </div>

                            {{-- Estrellas --}}
                            <div class="d-flex align-items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $resena->puntuacion)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                @endfor
                                <span class="text-muted small ms-1">({{ $resena->puntuacion }}/5)</span>
                            </div>
                        </div>

                        {{-- Badge Estado --}}
                        <div>
                            @if($resena->estado === 'aprobada')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>Aprobada
                                </span>
                            @elseif($resena->estado === 'reportada')
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Reportada
                                </span>
                            @elseif($resena->estado === 'pendiente')
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-2">
                                    <i class="bi bi-hourglass-split me-1"></i>Pendiente
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Comentario --}}
                    <div class="bg-light rounded-3 p-3 mb-3">
                        <p class="mb-0 text-dark">
                            <i class="bi bi-quote text-muted me-2"></i>
                            {{ $resena->comentario }}
                        </p>
                    </div>

                    {{-- Motivo de reporte --}}
                    @if($resena->estado === 'reportada' && $resena->motivo_reporte)
                        <div class="alert alert-danger bg-danger bg-opacity-10 border-danger rounded-3 d-flex align-items-start py-3 mb-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger me-3 fs-5"></i>
                            <div>
                                <strong class="d-block mb-1">Motivo del reporte:</strong>
                                <small>{{ $resena->motivo_reporte }}</small>
                            </div>
                        </div>
                    @endif

                    {{-- BOTONES DE ACCIÓN --}}
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        
                        {{-- Ver detalles --}}
                        <a href="{{ route('admin.resenas.show', $resena->id) }}"
                           class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="bi bi-eye-fill me-1"></i>
                            Ver detalles
                        </a>
                    
                        <div class="d-flex gap-2">
                    
                            {{-- Aprobar --}}
                            @if($resena->estado === 'reportada' || $resena->estado === 'pendiente')
                                <form action="{{ route('admin.resenas.aprobar', $resena->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm rounded-pill">
                                        <i class="bi bi-check2-circle me-1"></i>
                                        Aprobar
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
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                    <i class="bi bi-trash3 me-1"></i>
                                    Desaprobar
                                </button>
                            </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                <i class="bi bi-chat-left-text text-muted mb-3" style="font-size: 4rem;"></i>
                <h5 class="fw-bold mb-2">No hay reseñas</h5>
                <p class="text-muted mb-0">No se encontraron reseñas con los filtros seleccionados</p>
            </div>
        @endforelse

    </div>
</div>

@endsection
</body>
</html>