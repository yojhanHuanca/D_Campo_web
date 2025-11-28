<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de pedido</title>
</head>
<body>
    @extends('admin.layout')

@section('content')

{{-- MODAL CON BOOTSTRAP --}}
<div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
     style="background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(5px); z-index:1050;">

    <div class="bg-white rounded-3 shadow-lg" style="max-width:550px; width:90%; max-height:85vh; overflow:hidden;">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start p-3 border-bottom">
            <div>
                <h6 class="fw-bold mb-1">Detalles del Pedido - DC-{{ $pedido->id }}</h6>
                <p class="text-muted small mb-0">Revisa y actualiza el estado del pedido</p>
            </div>
            <a href="{{ route('admin.pedidos.index') }}" class="btn-close"></a>
        </div>

        {{-- BODY --}}
        <div class="p-3" style="overflow-y:auto; max-height:70vh;">

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
            @if ($pedido->comprobante)
                <div class="mb-3">
                    <p class="fw-semibold small mb-1">Comprobante de pago</p>

                    {{-- Probar diferentes rutas donde podría estar guardada la imagen --}}
                    @if(file_exists(public_path('storage/comprobantes/' . $pedido->comprobante)))
                        <img src="{{ asset('storage/comprobantes/' . $pedido->comprobante) }}" width="200">
                             class="rounded border shadow-sm" 
                             style="width: 100%; max-width: 300px; object-fit: cover;"
                             alt="Comprobante de pago">
                    @elseif(file_exists(storage_path('app/public/comprobantes/' . $pedido->comprobante)))
                        <<img src="{{ asset('storage/comprobantes/' . $pedido->comprobante) }}" width="200">
                             class="rounded border shadow-sm" 
                             style="width: 100%; max-width: 300px; object-fit: cover;"
                             alt="Comprobante de pago">
                    @else
                        <div class="alert alert-warning p-2 small">
                            <i class="bi bi-exclamation-triangle"></i>
                            
                            Comprobante encontrado en base de datos pero archivo no encontrado.
                            <br>
                            <small>Nombre: {{ $pedido->comprobante }}</small>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-muted small">No se subió comprobante.</p>
            @endif

            {{-- Formulario para cambiar estado --}}
            <form action="{{ route('admin.pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-3">
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
                            class="btn btn-sm btn-success rounded-pill px-3">
                        Actualizar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

</body>
</html>