<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carrito</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Mi Carrito</h2>

    @if($items->isEmpty())

        {{-- CARRITO VACÍO --}}
        <div class="text-center py-5">

            <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png"
                 width="110" class="mb-4">

            <h3 class="fw-bold">Tu carrito está vacío</h3>

            <p class="text-muted mt-2">
                Agrega tus productos favoritos para comenzar tu compra.
            </p>

            <a href="{{ route('store.index') }}" class="btn btn-success mt-3 px-4">
                🛍 Explorar productos
            </a>

            <br><br>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4">
                ← Volver al inicio
            </a>

        </div>

    @else

        @php
            $subtotal = 0;
        @endphp

        @foreach($items as $item)
            @php
                $subtotal += $item->producto->precio * $item->cantidad;
            @endphp

            <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-3">

                <div>
                    <strong>{{ $item->producto->nombre }}</strong>
                    <div class="text-muted">
                        S/ {{ number_format($item->producto->precio, 2) }}
                    </div>
                </div>

                <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                    <input type="number"
                           name="cantidad"
                           min="1"
                           value="{{ $item->cantidad }}"
                           class="form-control"
                           style="width:80px;">

                    <button class="btn btn-sm btn-primary ms-2">Actualizar</button>
                </form>

                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        @endforeach

        {{-- Resumen --}}
        <div class="border p-3 rounded mt-4">
            <h5>Resumen del pedido</h5>

            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>S/ {{ number_format($subtotal, 2) }}</span>
            </div>

            @php
                $igv = $subtotal * 0.18;
            @endphp

            <div class="d-flex justify-content-between">
                <span>IGV (18%)</span>
                <span>S/ {{ number_format($igv, 2) }}</span>
            </div>

            <hr>

            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>S/ {{ number_format($subtotal + $igv, 2) }}</span>
            </div>

            <button class="btn btn-success w-100 mt-3">
                Continuar con el envío →
            </button>
        </div>

    @endif

</div>
@endsection

</body>
</html>