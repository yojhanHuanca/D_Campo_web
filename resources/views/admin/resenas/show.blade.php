<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas - Detalles</title>
</head>
<body>
@extends('admin.layout')

@section('content')

{{-- FONDO BLUR SEMI TRANSPARENTE --}}
<div style="
    position: fixed;
    inset:0;
    backdrop-filter: blur(6px);
    background: rgba(0,0,0,0.35);
    z-index: 998;
"></div>

{{-- MODAL FLOTANTE --}}
<div style="
    position: fixed;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 95%;
    max-width: 650px;
    z-index: 999;
">

    <div class="card shadow-lg border-0" style="border-radius: 14px;">
        <div class="card-body px-4 py-3">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-bold mb-0">Detalles de la Reseña</h5>
                    <p class="text-muted small mb-0">Información completa de la reseña.</p>
                </div>
                <a href="{{ route('admin.resenas.index') }}" class="btn-close"></a>
            </div>

            {{-- USUARIO + FECHA --}}
            <div class="d-flex justify-content-between align-items-start mb-3">

                <div>
                    <h6 class="fw-bold mb-1">{{ $resena->usuario->name }}</h6>
                    <p class="text-muted small mb-1">ID Usuario: user{{ $resena->usuario->id }}</p>
                </div>

                <div class="text-end">
                    <div class="mb-1">
                        @for ($i=1; $i<=5; $i++)
                            @if($i <= $resena->calificacion)
                                <span class="text-warning fs-5">★</span>
                            @else
                                <span class="text-muted fs-5">☆</span>
                            @endif
                        @endfor
                    </div>
                    <p class="text-muted small mb-0">{{ $resena->created_at->format('d/m/Y') }}</p>
                </div>

            </div>

            {{-- PRODUCTO --}}
            <h6 class="fw-bold mb-1">Producto</h6>
            <div class="border rounded p-2 bg-white mb-3">
                <p class="mb-0">{{ $resena->producto->nombre }}</p>
                <p class="text-muted small mb-0">ID: {{ $resena->producto->id }}</p>
            </div>

            {{-- COMENTARIO --}}
            <h6 class="fw-bold mb-1">Comentario</h6>
            <div class="border rounded p-2 bg-white mb-3">
                <p class="mb-0">{{ $resena->comentario }}</p>
            </div>

            {{-- ESTADO + REPORTE --}}
            <div class="row g-3 mb-3">

                <div class="col-md-6">
                    <h6 class="fw-bold mb-1">Estado</h6>

                    @if($resena->estado === 'aprobada')
                        <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-1">
                            <i class="bi bi-check-circle me-1"></i>Aprobada
                        </span>
                    @elseif($resena->estado === 'reportada')
                        <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-1">
                            <i class="bi bi-exclamation-triangle me-1"></i>Reportada
                        </span>
                    @else
                        <span class="badge bg-secondary rounded-pill px-3 py-1">Pendiente</span>
                    @endif
                </div>

                @if($resena->estado === 'reportada')
                <div class="col-md-6">
                    <h6 class="fw-bold mb-1">Motivo del reporte</h6>
                    <div class="alert alert-danger small py-2 border-danger mb-0">
                        {{ $resena->motivo_reporte }}
                    </div>
                </div>
                @endif

            </div>

            {{-- BOTONES --}}
            <div class="d-flex justify-content-between mt-3">

                {{-- CERRAR --}}
                <a href="{{ route('admin.resenas.index') }}"
                   class="btn btn-secondary px-3 d-flex align-items-center gap-1">
                    <i class="bi bi-x-circle"></i> Cerrar
                </a>

                <div class="d-flex gap-2">

                    {{-- APROBAR --}}
                    @if($resena->estado === 'reportada')
                        <form action="{{ route('admin.resenas.aprobar', $resena->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success px-3 d-flex align-items-center gap-1">
                                <i class="bi bi-check-circle"></i> Aprobar
                            </button>
                        </form>
                    @endif

                    {{-- ELIMINAR --}}
                    <form action="{{ route('admin.resenas.eliminar', $resena->id) }}"
                          method="POST"
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta reseña?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger px-3 d-flex align-items-center gap-1">
                            <i class="bi bi-trash"></i> Desaprobar 
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection

</body>
</html>
    