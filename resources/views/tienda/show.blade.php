<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detalle_tienda </title>
</head>
<body>
    @extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- Volver y migas de pan --}}
    <div class="mb-3">
        <a href="{{ route('store.index') }}" class="text-decoration-none">
            ← Volver a la tienda
        </a>
        <div class="small text-muted">
            Inicio  ›  Tienda  ›  {{ $producto->categoria->nombre ?? 'Categoría' }}
        </div>
    </div>

    {{-- Cabecera: imagen + info principal --}}
    <div class="row g-4 mb-5">
        {{-- Imagen grande --}}
        <div class="col-md-6">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}"
                     class="img-fluid rounded"
                     alt="{{ $producto->nombre }}">
            @else
                <div class="bg-light border rounded"
                     style="width:100%;height:380px;"></div>
            @endif
        </div>

        {{-- Info principal --}}
        <div class="col-md-6">

            <h2 class="fw-bold">{{ $producto->nombre }}</h2>

            {{-- Descripción corta --}}
            <p class="text-muted">
                {{ $producto->descripcion }}
            </p>

            {{-- Precio --}}
            <h3 class="text-success fw-bold mb-3">
                S/ {{ number_format($producto->precio, 2) }}
            </h3>

            {{-- Ingredientes clave (por ahora estático, luego puedes usar campos de BD) --}}
            <div class="mb-3">
                <div class="small text-muted mb-1">Ingredientes clave</div>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge text-bg-success">Palta Orgánica</span>
                    <span class="badge text-bg-success">Vitamina E</span>
                    <span class="badge text-bg-success">Omega-3</span>
                </div>
            </div>

            {{-- Cantidad + botón agregar al carrito --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                @csrf

                <input type="hidden" name="product_id" value="{{ $producto->id }}">

                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <div class="d-flex" style="max-width:200px;">
                        {{-- Por ahora solo input numérico, luego se puede hacer +- con JS --}}
                        <input type="number"
                               name="cantidad"
                               value="1"
                               min="1"
                               max="{{ $producto->stock ?? 99 }}"
                               class="form-control">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success w-100">
                    Agregar al carrito
                </button>
            </form>

            {{-- Información adicional pequeña --}}
            <div class="mt-3 small text-muted">
                Stock disponible:
                <strong>{{ $producto->stock ?? '—' }}</strong>
            </div>

        </div>
    </div>

    {{-- Galería + Beneficios --}}
    <div class="row g-4 mb-5">
        {{-- Galería simple (por ahora repetimos la imagen principal) --}}
        <div class="col-md-6">
            <div class="d-flex gap-3">
                @for($i = 0; $i < 4; $i++)
                    <div class="border rounded" style="width:100px;height:80px;overflow:hidden;">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                 class="w-100 h-100"
                                 style="object-fit:cover;">
                        @else
                            <div class="bg-light w-100 h-100"></div>
                        @endif
                    </div>
                @endfor
            </div>

            <div class="mt-4">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <strong>Envío gratis</strong><br>
                            <span class="small text-muted">En compras +S/150</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded">
                            <strong>Compra segura</strong><br>
                            <span class="small text-muted">100% protegida</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded mt-3">
                            <strong>Devolución fácil</strong><br>
                            <span class="small text-muted">Hasta 30 días</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded mt-3">
                            <strong>100% Natural</strong><br>
                            <span class="small text-muted">Certificado orgánico</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Beneficios principales --}}
        <div class="col-md-6">
            <h5>Beneficios principales</h5>
            <ul class="small">
                <li>Hidratación profunda y duradera</li>
                <li>Protección antioxidante</li>
                <li>Nutrición intensiva 24h</li>
                <li>Reduce líneas de expresión</li>
                <li>Mejora la elasticidad de la piel</li>
                <li>Textura ligera no grasosa</li>
            </ul>
        </div>
    </div>

    {{-- Modo de uso / Ingredientes / Reseñas (estructura simple) --}}
    <div class="mb-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#modo-uso">
                    Modo de uso
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ingredientes">
                    Ingredientes
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#resenas">
                    Reseñas (3+)
                </button>
            </li>
        </ul>

        <div class="tab-content p-3 border-bottom border-start border-end rounded-bottom">
            <div class="tab-pane fade show active" id="modo-uso">
                <h6>¿Cómo usar este producto?</h6>
                <p class="small">
                    Aplicar 2–3 gotas en el rostro limpio por la noche.
                    Masajear suavemente con movimientos circulares ascendentes
                    hasta completa absorción. Usar diariamente para mejores resultados.
                </p>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <strong>100% Orgánico</strong><br>
                            <span class="small text-muted">Certificado</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <strong>Cruelty Free</strong><br>
                            <span class="small text-muted">No testeado en animales</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <strong>Sin parabenos</strong><br>
                            <span class="small text-muted">Fórmula limpia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="ingredientes">
                <h6>Ingredientes completos</h6>
                <p class="small">
                    Aquí podrás listar todos los ingredientes del producto en formato INCI.
                    (Luego podemos traer este texto desde la base de datos si lo agregas como campo).
                </p>
            </div>

            <div class="tab-pane fade" id="resenas">
                <h6>Reseñas</h6>
                <p class="small text-muted">
                    Aquí más adelante mostraremos las reseñas reales de los clientes.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection

</body>
</html>
