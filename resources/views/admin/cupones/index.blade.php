@extends('admin.layout')

@section('content')

<div class="container-fluid py-4">

    {{-- ENCABEZADO FIJO --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-ticket-perforated text-success me-2"></i>
                    Gestión de Cupones
                </h4>
                <p class="text-muted small mb-0">Crea y administra cupones de descuento para tus clientes</p>
            </div>
            <button type="button" class="btn btn-success rounded-pill shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#modalNuevoCupon">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Cupón
            </button>
        </div>

        {{-- BUSCADOR --}}
        <form method="GET" action="{{ route('admin.cupones.index') }}">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 ps-0"
                       placeholder="Buscar cupones..." value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    {{-- ESTADÍSTICAS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <small class="text-muted d-block mb-1">Total Cupones</small>
                    <h4 class="fw-bold mb-0">{{ $cupones->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <small class="text-success d-block mb-1">Activos</small>
                    <h4 class="fw-bold mb-0 text-success">{{ $cupones->where('activo', true)->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <small class="text-muted d-block mb-1">Inactivos</small>
                    <h4 class="fw-bold mb-0">{{ $cupones->where('activo', false)->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <small class="text-danger d-block mb-1">Expirados</small>
                    <h4 class="fw-bold mb-0 text-danger">{{ $cupones->filter(fn($c) => $c->expirado)->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTA DE CUPONES CON SCROLL --}}
    <div class="overflow-auto" style="max-height: 600px;">
        <div class="row g-3">

            @forelse ($cupones as $cupon)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    {{-- Header con Badge --}}
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 40px; height: 40px;">
                                <i class="bi bi-ticket-perforated-fill text-success fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $cupon->codigo }}</h6>
                                <small class="text-muted">{{ $cupon->etiqueta_descuento }}</small>
                            </div>
                        </div>

                        {{-- Estado --}}
                        @if ($cupon->expirado)
                            <span class="badge bg-danger rounded-pill">Expirado</span>
                        @elseif ($cupon->expiraPronto)
                            <span class="badge bg-warning text-dark rounded-pill">Expira pronto</span>
                        @else
                            <span class="badge bg-success rounded-pill">Activo</span>
                        @endif
                    </div>

                    <div class="card-body p-3">

                        {{-- Descripción --}}
                        <p class="text-muted small mb-3">
                            {{ $cupon->descripcion ?? 'Sin descripción' }}
                        </p>

                        {{-- Información --}}
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Expira</small>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-calendar-event text-success"></i>
                                    <small class="fw-semibold">{{ $cupon->fecha_fin }}</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Compra mínima</small>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-cash text-success"></i>
                                    <small class="fw-semibold">S/ {{ number_format($cupon->compra_minima, 2) }}</small>
                                </div>
                            </div>
                        </div>

                        {{-- Barra de progreso de usos --}}
                        @if ($cupon->limite_uso)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted">
                                    <i class="bi bi-graph-up me-1"></i>Usos
                                </small>
                                <small class="fw-semibold">{{ $cupon->usos_realizados }} / {{ $cupon->limite_uso }}</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success"
                                     style="width: {{ $cupon->limite_uso > 0 ? ($cupon->usos_realizados / $cupon->limite_uso) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Toggle Activo/Inactivo --}}
                        <div class="d-flex align-items-center justify-content-between mb-3 p-2 bg-light rounded-3">
                            <small class="fw-semibold">
                                <i class="bi bi-power text-success me-1"></i>
                                Estado
                            </small>
                            <form action="{{ route('admin.cupones.toggle', $cupon->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" 
                                           {{ $cupon->activo ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                </div>
                            </form>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#modalEditarCupon{{ $cupon->id }}">
                                <i class="bi bi-pencil-square me-1"></i>Editar
                            </button>

                            <form action="{{ route('admin.cupones.destroy', $cupon->id) }}" method="POST" class="flex-fill"
                                  onsubmit="return confirm('¿Eliminar cupón {{ $cupon->codigo }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100">
                                    <i class="bi bi-trash me-1"></i>Eliminar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- MODAL EDITAR --}}
            <div class="modal fade" id="modalEditarCupon{{ $cupon->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <div>
                                <h5 class="modal-title fw-bold">Editar Cupón</h5>
                                <p class="text-muted small mb-0">Modifica la información del cupón. Los campos marcados con * son obligatorios.</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('admin.cupones.update', $cupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label fw-semibold small">Código del cupón *</label>
                                        <input type="text" name="codigo" class="form-control" value="{{ $cupon->codigo }}" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold small">Descuento (%) *</label>
                                        <input type="number" step="0.01" name="valor" class="form-control" value="{{ $cupon->valor }}" required>
                                    </div>

                                    <input type="hidden" name="tipo" value="porcentaje">

                                    <div class="col-12">
                                        <label class="form-label fw-semibold small">Descripción</label>
                                        <textarea name="descripcion" class="form-control" rows="2">{{ $cupon->descripcion }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold small">Fecha expiración *</label>
                                        <input type="date" name="fecha_fin" class="form-control" value="{{ $cupon->fecha_fin }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold small">Compra mínima (S/)</label>
                                        <input type="number" step="0.01" name="compra_minima" class="form-control" value="{{ $cupon->compra_minima }}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold small">Máximo de usos</label>
                                        <input type="number" name="limite_uso" class="form-control" value="{{ $cupon->limite_uso }}" placeholder="Dejar vacío para ilimitado">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" name="activo" value="1" {{ $cupon->activo ? 'checked' : '' }}>
                                            <label class="form-check-label">Activar cupón inmediatamente</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    <i class="bi bi-check-circle me-2"></i>Actualizar Cupón
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                    <i class="bi bi-ticket-perforated text-muted mb-3" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold mb-2">No se encontraron cupones</h5>
                    <p class="text-muted mb-4">Crea tu primer cupón de descuento para tus clientes</p>
                    <button type="button" class="btn btn-success rounded-pill px-4"
                            data-bs-toggle="modal" data-bs-target="#modalNuevoCupon">
                        <i class="bi bi-plus-circle me-2"></i>Crear Cupón
                    </button>
                </div>
            </div>
            @endforelse

        </div>
    </div>

</div>

{{-- MODAL NUEVO CUPÓN --}}
<div class="modal fade" id="modalNuevoCupon" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Nuevo Cupón</h5>
                    <p class="text-muted small mb-0">Crea un nuevo cupón de descuento para tus clientes. Los campos marcados con * son obligatorios.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.cupones.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Código del cupón *</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ej: NATURAL10" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Descuento (%) *</label>
                            <input type="number" step="0.01" name="valor" class="form-control" placeholder="10" required>
                        </div>

                        <input type="hidden" name="tipo" value="porcentaje">

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="2" placeholder="Describe el cupón..."></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Fecha expiración *</label>
                            <input type="date" name="fecha_fin" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Compra mínima (S/)</label>
                            <input type="number" step="0.01" name="compra_minima" class="form-control" value="0" placeholder="50.00">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">Máximo de usos</label>
                            <input type="number" name="limite_uso" class="form-control" placeholder="Dejar vacío para ilimitado">
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="activo" value="1" checked>
                                <label class="form-check-label">Activar cupón inmediatamente</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-check-circle me-2"></i>Crear Cupón
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection