<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

@include('partials.header')

{{-- HERO CAROUSEL --}}
<div id="heroCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="position-relative" style="height: 500px; background: linear-gradient(135deg, #8fa88e 0%, #c4b5a0 100%);">
                {{-- Aquí va tu imagen de fondo --}}
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 text-white">
                                <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill mb-3">
                                    <i class="bi bi-stars me-1"></i> Productos Destacados
                                </span>
                                <h1 class="display-3 fw-bold mb-3">Cosmética Natural Premium</h1>
                                <p class="fs-5 mb-0">Descubre nuestra colección de productos elaborados con palta 100% orgánica</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="carousel-item">
            <div class="position-relative" style="height: 500px; background: linear-gradient(135deg, #7a9b7e 0%, #d4c39a 100%);">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 text-white">
                                <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill mb-3">
                                    <i class="bi bi-stars me-1"></i> Productos Destacados
                                </span>
                                <h1 class="display-3 fw-bold mb-3">100% Natural</h1>
                                <p class="fs-5 mb-0">Cuidado natural para tu piel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="carousel-item">
            <div class="position-relative" style="height: 500px; background: linear-gradient(135deg, #6c9a78 0%, #c7b597 100%);">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 text-white">
                                <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill mb-3">
                                    <i class="bi bi-stars me-1"></i> Productos Destacados
                                </span>
                                <h1 class="display-3 fw-bold mb-3">Orgánico Premium</h1>
                                <p class="fs-5 mb-0">Lo mejor de la naturaleza</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container mb-5">
    
    {{-- BARRA DE BÚSQUEDA --}}
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <div class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Buscar productos...">
            </div>
        </div>
    </div>

    {{-- FILTROS HORIZONTALES --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 bg-white">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-funnel text-success me-2"></i>
                <h6 class="mb-0 fw-bold">Filtrar productos</h6>
            </div>
            
            <div class="row g-3">
                {{-- Categoría --}}
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted mb-2">Categoría</label>
                    <form method="GET" action="{{ route('store.index') }}">
                        <select name="categoria" class="form-select border-0 bg-light" onchange="this.form.submit()">
                            <option value="">Todos los productos</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ isset($categoriaId) && $categoriaId == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if(isset($busqueda))
                            <input type="hidden" name="q" value="{{ $busqueda }}">
                        @endif
                    </form>
                </div>

                {{-- Ordenar por --}}
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted mb-2">Ordenar por</label>
                    <select class="form-select border-0 bg-light">
                        <option selected>Destacados</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                    </select>
                </div>

                {{-- Rango de precio --}}
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted mb-2">Rango de precio</label>
                    <div class="d-flex align-items-center">
                        <small class="text-muted me-2">S/ 0</small>
                        <input type="range" class="form-range flex-grow-1" min="0" max="100">
                        <small class="text-muted ms-2">S/ 100</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTADOR --}}
    <p class="text-muted mb-4">
        <strong>{{ $productos->count() }}</strong> productos encontrados
    </p>

    {{-- GRID DE PRODUCTOS --}}
    <div class="row g-4">
        @forelse ($productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative product-card">
                    
                    {{-- ICONOS QUE APARECEN AL HACER HOVER --}}
                    <div class="position-absolute top-0 end-0 m-3 d-flex flex-column gap-2 product-icons" style="z-index: 10; opacity: 0; transition: opacity 0.3s;">
                        <button class="btn btn-white btn-sm rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-heart"></i>
                        </button>
                        <a href="{{ route('store.show', $producto->id) }}" class="btn btn-white btn-sm rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>

                    {{-- Imagen (clickable) --}}
                    <a href="{{ route('store.show', $producto->id) }}" class="text-decoration-none">
                        <div style="height: 280px; overflow: hidden; cursor: pointer;">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                     class="w-100 h-100 object-fit-cover"
                                     alt="{{ $producto->nombre }}">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted fs-1"></i>
                                </div>
                            @endif
                        </div>
                    </a>

                    {{-- BOTÓN AGREGAR QUE APARECE AL HOVER --}}
                    <div class="position-absolute bottom-0 start-0 end-0 p-3 product-add-btn" style="opacity: 0; transition: opacity 0.3s; z-index: 20;">
                        <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-light w-100 rounded-pill shadow" onclick="event.stopPropagation();">
                                <i class="bi bi-cart-plus me-2"></i>Agregar
                            </button>
                        </form>
                    </div>

                    <div class="card-body p-3">
                        {{-- Rating --}}
                        <div class="mb-2">
                            <i class="bi bi-star-fill text-warning small"></i>
                            <small class="text-muted ms-1">4.{{ rand(5,9) }}</small>
                        </div>

                        {{-- Nombre --}}
                        <h6 class="fw-bold mb-2">{{ $producto->nombre }}</h6>

                        {{-- Descripción --}}
                        <p class="text-muted small mb-3" style="height: 40px; overflow: hidden;">
                            {{ Str::limit($producto->descripcion, 60) }}
                        </p>

                        {{-- Precio --}}
                        <h5 class="fw-bold text-dark mb-0">
                            S/ {{ number_format($producto->precio, 2) }}
                        </h5>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted display-1 mb-3"></i>
                    <h5 class="text-muted">No hay productos disponibles</h5>
                </div>
            </div>
        @endforelse
    </div>

</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- SCRIPT PARA EFECTOS HOVER --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.product-card');
    
    cards.forEach(card => {
        const icons = card.querySelector('.product-icons');
        const addBtn = card.querySelector('.product-add-btn');
        
        card.addEventListener('mouseenter', function() {
            if (icons) icons.style.opacity = '1';
            if (addBtn) addBtn.style.opacity = '1';
        });
        
        card.addEventListener('mouseleave', function() {
            if (icons) icons.style.opacity = '0';
            if (addBtn) addBtn.style.opacity = '0';
        });
    });
});
</script>

</body>
</html>