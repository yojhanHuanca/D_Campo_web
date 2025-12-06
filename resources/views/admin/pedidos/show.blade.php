@extends('admin.layout')

@section('content')
<div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
     style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(5px); z-index:1050;">

    <div class="bg-white rounded-3 shadow-lg" style="max-width:550px; width:90%; max-height:85vh; overflow:hidden;">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start p-3 border-bottom bg-light">
            <div>
                <h6 class="fw-bold mb-1">Detalles del Pedido - DC-{{ $pedido->id }}</h6>
                <p class="text-muted small mb-0">Revisa y actualiza el estado del pedido</p>
            </div>
            <a href="{{ route('admin.pedidos.index') }}" class="btn-close"></a>
        </div>

        {{-- BODY --}}
        <div class="p-3" style="overflow-y:auto; max-height:70vh;">
            @php
                $estadoColor = [
                    'pendiente' => 'warning',
                    'pagado' => 'info',
                    'enviado' => 'primary',
                    'entregado' => 'success',
                    'cancelado' => 'danger',
                ][$pedido->estado] ?? 'secondary';
            @endphp

            <div class="alert alert-{{ $estadoColor }} bg-opacity-10 border-0 d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-truck fs-5"></i>
                <div>
                    <div class="fw-semibold mb-0 text-capitalize">Estado: {{ $pedido->estado }}</div>
                    <small class="text-muted">Actualiza el estado y se reflejará en el listado.</small>
                </div>
            </div>

            {{-- Info general --}}
            <div class="row mb-3">
                <div class="col-6">
                    <p class="text-muted small mb-1">Fecha</p>
                    <p class="fw-semibold small mb-0">
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <div class="col-6 text-end">
                    <p class="text-muted small mb-1">Total</p>
                    <p class="fw-bold text-success mb-0">S/ {{ number_format($pedido->total, 2) }}</p>
                </div>
            </div>

            {{-- Cupón aplicado --}}
            @if($pedido->codigo_cupon && $pedido->descuento > 0)
                <div class="mt-3 p-2 rounded-3 border bg-success bg-opacity-10">
                    <p class="small fw-bold text-success mb-1">
                        <i class="bi bi-tag-fill me-1"></i> Cupón aplicado
                    </p>
            
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Código:</span>
                        <span class="fw-semibold small">{{ $pedido->codigo_cupon }}</span>
                    </div>
            
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Descuento:</span>
                        <span class="fw-semibold text-success small">
                            - S/ {{ number_format($pedido->descuento, 2) }}
                        </span>
                    </div>
            
                    @if($pedido->cupon)
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Tipo:</span>
                            <span class="small fw-semibold">
                                {{ $pedido->cupon->tipo === 'porcentaje' ? $pedido->cupon->valor . '%' : 'Monto fijo' }}
                            </span>
                        </div>
                    @endif
                </div>
            @endif
            

            {{-- Productos --}}
            <h6 class="fw-bold mb-2 small">Productos del pedido</h6>

            <div style="max-height:200px; overflow-y:auto;">
                @foreach ($pedido->items as $item)
                    <div class="d-flex align-items-center bg-light border rounded-2 p-2 mb-2">
                        @if($item->producto && $item->producto->imagen)
                            <img src="{{ asset('storage/'.$item->producto->imagen) }}"
                                 style="width:45px; height:45px; object-fit:cover;"
                                 class="rounded me-2">
                        @endif

                        <div class="flex-grow-1">
                            <p class="fw-semibold mb-0 small">{{ $item->producto->nombre ?? 'Producto eliminado' }}</p>
                            <small class="text-muted">
                                S/ {{ number_format($item->precio, 2) }} × {{ $item->cantidad }}
                            </small>
                        </div>

                        <span class="fw-bold small">
                            S/ {{ number_format($item->precio * $item->cantidad, 2) }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- COMPROBANTE DE PAGO --}}
            @php
                $comprobante = $pedido->comprobante ?: ($pedido->pago->comprobante ?? null);
                $comprobanteUrl = null;
                if ($comprobante) {
                    $publicPath = \Illuminate\Support\Facades\Storage::disk('public')->path('comprobantes/' . $comprobante);
                    if (file_exists($publicPath)) {
                        $mime = mime_content_type($publicPath);
                        $base64 = base64_encode(file_get_contents($publicPath));
                        $comprobanteUrl = "data:{$mime};base64,{$base64}";
                    } else {
                        $comprobanteUrl = asset('storage/comprobantes/' . rawurlencode($comprobante));
                    }
                }
            @endphp

            @if ($comprobante)
                <div class="mb-3">
                    <p class="fw-semibold small mb-1">Comprobante de pago</p>
                    <img src="{{ $comprobanteUrl }}"
                         class="rounded border shadow-sm"
                         style="width: 100%; max-width: 300px; object-fit: cover;"
                         alt="Comprobante de pago"
                         onerror="this.onerror=null; this.replaceWith(document.createTextNode('Comprobante no encontrado: {{ $comprobante }}'));"
                    >
                    <small class="text-muted d-block mt-1">Archivo: {{ $comprobante }}</small>
                </div>
            @else
                <p class="text-muted small">No se subió comprobante.</p>
            @endif

            @php
                $codigoOperacion = $pedido->codigo_operacion ?: ($pedido->pago->codigo_operacion ?? null);
            @endphp
            @if ($codigoOperacion)
                <div class="mb-3">
                    <p class="fw-semibold small mb-1">Código de operación</p>
                    <p class="mb-0 small">{{ $codigoOperacion }}</p>
                </div>
            @endif

            {{-- Formulario para cambiar estado --}}
            <form id="estadoForm" action="{{ route('admin.pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-3">
                @csrf

                <label class="form-label fw-semibold small mb-2">Actualizar estado</label>
                <select name="estado" class="form-select form-select-sm mb-3">

                    <option value="pendiente"  {{ $pedido->estado=='pendiente'?'selected':'' }}>Pendiente</option>
                    <option value="pagado"     {{ $pedido->estado=='pagado'?'selected':'' }}>Pagado</option>
                    <option value="enviado"    {{ $pedido->estado=='enviado'?'selected':'' }}>Enviado</option>
                    <option value="entregado"  {{ $pedido->estado=='entregado'?'selected':'' }}>Entregado</option>
                    <option value="cancelado"  {{ $pedido->estado=='cancelado'?'selected':'' }}>Cancelado</option>

                </select>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pedidos.index') }}"
                       class="btn btn-sm btn-secondary rounded-pill px-3">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn btn-sm btn-success rounded-pill px-3" id="submitEstado">
                        <span class="submit-text">Actualizar</span>
                        <span class="submit-spinner d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    const formEstado = document.getElementById('estadoForm');
    const submitBtn = document.getElementById('submitEstado');
    const submitText = submitBtn?.querySelector('.submit-text');
    const submitSpinner = submitBtn?.querySelector('.submit-spinner');

    formEstado?.addEventListener('submit', () => {
        submitBtn?.setAttribute('disabled', 'disabled');
        submitText?.classList.add('opacity-0');
        submitSpinner?.classList.remove('d-none');
    });
</script>
@endpush
@endsection
