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

    {{-- Si el carrito está vacío --}}
    @if($items->isEmpty())

        <div class="text-center py-5">

            <img src="https://cdn-icons-png.flaticon.com/512/102/102661.png"
                 alt="Carrito vacío"
                 width="120"
                 class="mb-4 opacity-75">

            <h4 class="fw-bold mb-3">Tu carrito está vacío</h4>

            <p class="text-muted mb-4">
                Parece que todavía no agregaste ningún producto.
            </p>

            <a href="{{ route('home') }}" class="btn btn-success">
                Ir a la tienda
            </a>

        </div>

    @else

        {{-- Carrito lleno --}}

        @foreach($items as $item)
            <div class="card mb-3">
                <div class="card-body d-flex">

                    {{-- Imagen --}}
                    @if($item->producto->imagen)
                        <img src="{{ asset('storage/' . $item->producto->imagen) }}"
                             width="80"
                             height="80"
                             class="rounded me-3">
                    @else
                        <div class="bg-light border me-3"
                             style="width:80px;height:80px;">
                        </div>
                    @endif

                    {{-- Datos --}}
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $item->producto->nombre }}</h5>

                        <p class="mb-1 text-muted">
                            Precio: S/ {{ number_format($item->precio_unitario, 2) }}
                        </p>

                        {{-- Actualizar cantidad --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                            @csrf
                            <input type="number" name="cantidad" min="1" value="{{ $item->cantidad }}"
                                   class="form-control w-25 me-2">
                            <button class="btn btn-primary btn-sm">Actualizar</button>
                        </form>
                    </div>

                    {{-- Eliminar --}}
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>

                </div>
            </div>
        @endforeach

        {{-- Vaciar carrito --}}
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger">Vaciar carrito</button>
        </form>

    @endif

</div>

@endsection


</body>
</html>