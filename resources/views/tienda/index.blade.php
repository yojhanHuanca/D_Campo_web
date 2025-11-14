<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <!-- 🌿 NAVBAR COMO EN TU IMAGEN -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success fs-4" href="#">
                D'CAMPO
            </a>

            <!-- Menú centrado -->
            <div class="navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Inicio</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="{{ route('store.index') }}">Tienda</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Nosotros</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Contacto</a></li>
                </ul>
            </div>

            <!-- Solo el icono del carrito (sin login) -->
            <div class="d-flex align-items-center">
                <a href="{{ route('cart.index') }}" class="text-dark fs-5 position-relative">
                    <i class="bi bi-cart3"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO DE LA PÁGINA -->
    <div class="container py-4">
        {{-- HERO SECTION --}}
        <section class="mb-5">
            <div class="p-5 mb-3 text-center" style="background:#e5f0e6; border-radius:16px;">
                <p class="mb-2 text-muted">Productos Destacados</p>
                <h1 class="fw-bold display-6">Cosmética Natural Premium</h1>
                <p class="mb-0 fs-5">
                    Descubre nuestra colección de productos elaborados con <strong>palta 100% orgánica</strong>.
                </p>
            </div>
        </section>

        {{-- ... el resto de tu contenido de tienda ... --}}
    </div>

    {{-- FILTROS --}}
    <section class="mb-4">
        <div class="p-4" style="background:#f8f8f8; border-radius:12px;">
            <h5 class="mb-3">Filtrar productos</h5>
            
            <div class="row g-4">
                {{-- Categoría --}}
                <div class="col-md-4">
                    <label class="form-label fw-medium">Categoría</label>
                    <select class="form-select">
                        <option selected>Todos los productos</option>
                    </select>
                </div>

                {{-- Ordenar por --}}
                <div class="col-md-4">
                    <label class="form-label fw-medium">Ordenar por</label>
                    <select class="form-select">
                        <option selected>Destacados</option>
                        <option>Precio menor a mayor</option>
                        <option>Precio mayor a menor</option>
                    </select>
                </div>

                {{-- Rango de precio --}}
                <div class="col-md-4">
                    <label class="form-label fw-medium">Rango de precio</label>
                    <div class="d-flex align-items-center">
                        <span class="me-2">S/ 0</span>
                        <input type="range" class="form-range flex-grow-1" min="0" max="100">
                        <span class="ms-2">S/ 100</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTADOR DE PRODUCTOS --}}
    <section class="mb-3">
        <p class="text-muted">
            <strong>{{ $productos->count() }}</strong> producto(s) encontrados
        </p>
    </section>

    {{-- GRID DE PRODUCTOS --}}
    <section class="mb-5">
        <div class="row g-4">
            @forelse ($productos as $producto)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm" style="border-radius:16px; overflow:hidden; border:0;">

                        {{-- Imagen del producto --}}
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                 class="card-img-top"
                                 alt="{{ $producto->nombre }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div style="height:200px; background:#f0f0f0; display:flex; align-items:center; justify-content:center;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column p-3">
                            {{-- Nombre --}}
                            <h6 class="card-title fw-bold mb-2">{{ $producto->nombre }}</h6>

                            {{-- Descripción corta --}}
                            <p class="small text-muted mb-2 flex-grow-1">
                                {{ Str::limit($producto->descripcion, 80) }}
                            </p>

                            {{-- Precio --}}
                            <p class="fw-bold text-success mb-3 fs-5">
                                S/ {{ number_format($producto->precio, 2) }}
                            </p>

                            {{-- Botones --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('store.show', $producto->id) }}"
                                   class="btn btn-outline-secondary btn-sm flex-fill">
                                    Ver detalles
                                </a>
                                
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-fill">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                    <label>Cantidad</label>
                                    <input type="number" name="cantidad" value="1" min="1" >
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        Agregar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No hay productos disponibles en la tienda.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>

</body>
</html>