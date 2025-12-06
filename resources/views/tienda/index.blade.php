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

@php
    // Pega aquí las URLs de las imágenes para cada slide del carrusel
    $heroImages = $heroImages ?? [
        'https://www.shutterstock.com/image-photo/whole-cut-avocados-on-light-600nw-2608036971.jpg',
        'https://www.senasa.gob.pe/senasacontigo/wp-content/uploads/2021/02/18-palta-hass.jpg',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyjV9fYZ6cYhdGtlUq3-Rcg5BsE8L4_-HCwSu9B2VifudUZvrmLrtEZVs&s',
    ];

    // Enlace opcional por slide (deja # si solo es imagen)
    $heroLinks = $heroLinks ?? ['#', '#', '#'];

    $favoritosIds = auth()->check()
        ? \App\Models\Favorito::where('user_id', auth()->id())->pluck('producto_id')->toArray()
        : [];
@endphp

{{-- HERO CAROUSEL --}}
<section class="pb-4">
    <div class="container">
        <div class="rounded-4 overflow-hidden shadow-sm position-relative">
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                
                <div class="carousel-inner">
                    {{-- Slide 1 con enlace --}}
                    <div class="carousel-item active">
                        <a href="{{ $heroLinks[0] ?? '#' }}" class="text-decoration-none text-white d-block">
                            <div class="position-relative hero-slide" style="background-image: url('{{ $heroImages[0] ?? '' }}');">
                                <div class="hero-overlay"></div>
                                <div class="hero-content container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill mb-3 shadow-sm">
                                                <i class="bi bi-stars me-1 text-success"></i> Productos Destacados
                                            </span>
                                            <h1 class="display-4 fw-bold text-white mb-3">Cosmética Natural Premium</h1>
                                            <p class="lead text-white-50 mb-4">Descubre nuestra colección de productos elaborados con palta 100% orgánica.</p>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success bg-opacity-75 text-white">Nuevo</span>
                                                <span class="badge bg-white text-success">Envío en 24h</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    {{-- Slide 2 con enlace --}}
                    <div class="carousel-item">
                        <a href="{{ $heroLinks[1] ?? '#' }}" class="text-decoration-none text-white d-block">
                            <div class="position-relative hero-slide" style="background-image: url('{{ $heroImages[1] ?? '' }}');">
                                <div class="hero-overlay"></div>
                                <div class="hero-content container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill mb-3 shadow-sm">
                                                <i class="bi bi-droplet-half me-1 text-success"></i> Hidratación pura
                                            </span>
                                            <h1 class="display-4 fw-bold text-white mb-3">100% Natural</h1>
                                            <p class="lead text-white-50 mb-4">Cuidado natural para tu piel con ingredientes de origen sostenible.</p>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success bg-opacity-75 text-white">Vegano</span>
                                                <span class="badge bg-white text-success">Sin parabenos</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    {{-- Slide 3 con enlace --}}
                    <div class="carousel-item">
                        <a href="{{ $heroLinks[2] ?? '#' }}" class="text-decoration-none text-white d-block">
                            <div class="position-relative hero-slide" style="background-image: url('{{ $heroImages[2] ?? '' }}');">
                                <div class="hero-overlay"></div>
                                <div class="hero-content container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill mb-3 shadow-sm">
                                                <i class="bi bi-flower1 me-1 text-success"></i> Fórmula botánica
                                            </span>
                                            <h1 class="display-4 fw-bold text-white mb-3">Orgánico Premium</h1>
                                            <p class="lead text-white-50 mb-4">Lo mejor de la naturaleza para tu rutina diaria de skincare.</p>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success bg-opacity-75 text-white">Certificado</span>
                                                <span class="badge bg-white text-success">Hecho en Perú</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5">
    
    {{-- BARRA DE BÚSQUEDA --}}
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <form method="GET" action="{{ route('store.index') }}#productos" class="input-group input-group-lg shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-success"></i>
                </span>
                <input type="text"
                       name="q"
                       class="form-control border-start-0 ps-0"
                       placeholder="Buscar productos..."
                       value="{{ $busqueda ?? '' }}">

                {{-- mantener filtros actuales --}}
                @if(isset($categoriaId) && $categoriaId !== '')
                    <input type="hidden" name="categoria" value="{{ $categoriaId }}">
                @endif
                @if(isset($orden))
                    <input type="hidden" name="orden" value="{{ $orden }}">
                @endif
                @if(isset($minPrice))
                    <input type="hidden" name="min_price" value="{{ $minPrice }}">
                @endif
                @if(isset($maxPrice))
                    <input type="hidden" name="max_price" value="{{ $maxPrice }}">
                @endif
            </form>
        </div>
    </div>

    {{-- FILTROS HORIZONTALES --}}
    <div class="row g-3 mb-4">
        {{-- Categoría --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 filter-card">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success me-2"><i class="bi bi-tag"></i></span>
                        <h6 class="mb-0 fw-semibold text-muted">Categoría</h6>
                    </div>
                    <form method="GET" action="{{ route('store.index') }}#productos">
                        <select name="categoria" class="form-select border-0 bg-light" onchange="this.form.submit()">
                            <option value="">Todas</option>
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
                        @if(isset($orden))
                            <input type="hidden" name="orden" value="{{ $orden }}">
                        @endif
                        @if(isset($minPrice))
                            <input type="hidden" name="min_price" value="{{ $minPrice }}">
                        @endif
                        @if(isset($maxPrice))
                            <input type="hidden" name="max_price" value="{{ $maxPrice }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- Ordenar por --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 filter-card">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success me-2"><i class="bi bi-sort-alpha-down"></i></span>
                        <h6 class="mb-0 fw-semibold text-muted">Ordenar</h6>
                    </div>
                    <form method="GET" action="{{ route('store.index') }}#productos">
                        @if(isset($busqueda))
                            <input type="hidden" name="q" value="{{ $busqueda }}">
                        @endif
                        @if(isset($categoriaId) && $categoriaId !== '')
                            <input type="hidden" name="categoria" value="{{ $categoriaId }}">
                        @endif
                        @if(isset($minPrice))
                            <input type="hidden" name="min_price" value="{{ $minPrice }}">
                        @endif
                        @if(isset($maxPrice))
                            <input type="hidden" name="max_price" value="{{ $maxPrice }}">
                        @endif
                        <select name="orden" class="form-select border-0 bg-light" onchange="this.form.submit()">
                            <option value="" {{ empty($orden) ? 'selected' : '' }}>Destacados</option>
                            <option value="precio_asc" {{ $orden === 'precio_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                            <option value="precio_desc" {{ $orden === 'precio_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        {{-- Rango de precio --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 filter-card">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success me-2"><i class="bi bi-cash-stack"></i></span>
                        <h6 class="mb-0 fw-semibold text-muted">Rango de precio</h6>
                    </div>
                    <form method="GET" action="{{ route('store.index') }}#productos">
                        @if(isset($busqueda))
                            <input type="hidden" name="q" value="{{ $busqueda }}">
                        @endif
                        @if(isset($categoriaId) && $categoriaId !== '')
                            <input type="hidden" name="categoria" value="{{ $categoriaId }}">
                        @endif
                        @if(isset($orden))
                            <input type="hidden" name="orden" value="{{ $orden }}">
                        @endif

                        <div class="bg-light rounded-3 px-3 py-3 shadow-sm">
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Mín: <strong id="minLabel">S/ {{ $minPrice ?? 0 }}</strong></span>
                                <span>Máx: <strong id="maxLabel">S/ {{ $maxPrice ?? 500 }}</strong></span>
                            </div>
                            <div class="position-relative" style="height: 24px;">
                                <input id="minRange" type="range" min="0" max="500" step="1"
                                       value="{{ $minPrice ?? 0 }}"
                                       class="form-range position-absolute top-0 start-0 w-100" style="pointer-events: auto;">
                                <input id="maxRange" type="range" min="0" max="500" step="1"
                                       value="{{ $maxPrice ?? 500 }}"
                                       class="form-range position-absolute top-0 start-0 w-100" style="pointer-events: auto;">
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button class="btn btn-success btn-sm rounded-pill px-3" type="submit">
                                    <i class="bi bi-funnel me-1"></i>Aplicar
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="min_price" id="minPriceInput" value="{{ $minPrice ?? 0 }}">
                        <input type="hidden" name="max_price" id="maxPriceInput" value="{{ $maxPrice ?? 500 }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTADOR --}}
    <p class="text-muted mb-4">
        <strong>{{ $productos->count() }}</strong> productos encontrados
    </p>

    {{-- GRID DE PRODUCTOS --}}
    <div id="productos" class="row g-4">
        @forelse ($productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative bg-white">
                    <div class="position-absolute top-0 end-0 m-3 d-flex flex-column gap-2 product-icons">
                        @php $esFavorito = in_array($producto->id, $favoritosIds); @endphp
                        <button type="button"
                                class="btn btn-white btn-sm rounded-circle shadow d-flex align-items-center justify-content-center toggle-fav"
                                data-producto="{{ $producto->id }}"
                                aria-label="Favorito">
                            <i class="bi {{ $esFavorito ? 'bi-heart-fill text-danger' : 'bi-heart text-danger' }}"></i>
                        </button>
                        <a href="{{ route('store.show', $producto->id) }}" class="btn btn-white btn-sm rounded-circle shadow d-flex align-items-center justify-content-center">
                            <i class="bi bi-eye text-success"></i>
                        </a>
                    </div>

                    <a href="{{ route('store.show', $producto->id) }}" class="text-decoration-none">
                        <div class="product-image">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="w-100 h-100 object-fit-cover" alt="{{ $producto->nombre }}">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted fs-1"></i>
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="position-absolute bottom-0 start-0 end-0 p-3 product-add-btn">
                        <form action="{{ route('cart.add') }}" method="POST" onclick="event.stopPropagation();" class="remember-scroll">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            @if(($producto->stock ?? 0) > 0)
                                <button type="submit" class="btn btn-success w-100 rounded-pill shadow">
                                    <i class="bi bi-cart-plus me-2"></i>Agregar
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary w-100 rounded-pill shadow disabled">
                                    <i class="bi bi-x-circle me-2"></i>Sin stock
                                </button>
                            @endif
                        </form>
                    </div>

                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="text-warning small d-flex align-items-center gap-1">
                                <i class="bi bi-star-fill"></i>
                                <span class="text-muted">4.{{ rand(5,9) }}</span>
                            </div>
                            @if(($producto->stock ?? 0) > 0)
                                <span class="badge bg-success bg-opacity-10 text-success">Stock: {{ $producto->stock }}</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">Agotado</span>
                            @endif
                        </div>

                        <h6 class="fw-bold mb-1">{{ $producto->nombre }}</h6>
                        <p class="text-muted small mb-3" style="height: 40px; overflow: hidden;">
                            {{ Str::limit($producto->descripcion, 60) }}
                        </p>

                        <div class="d-flex align-items-center">
                            <h5 class="fw-bold text-dark mb-0">S/ {{ number_format($producto->precio, 2) }}</h5>
                        </div>
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

        // Mantener iconos visibles siempre
        if (icons) icons.style.opacity = '1';
        
        card.addEventListener('mouseenter', function() {
            if (addBtn) addBtn.style.opacity = '1';
        });
        
        card.addEventListener('mouseleave', function() {
            if (addBtn) addBtn.style.opacity = '0';
        });
    });

    // Slider doble para rango de precios
    const minRange = document.getElementById('minRange');
    const maxRange = document.getElementById('maxRange');
    const minLabel = document.getElementById('minLabel');
    const maxLabel = document.getElementById('maxLabel');
    const minInput = document.getElementById('minPriceInput');
    const maxInput = document.getElementById('maxPriceInput');

    if (minRange && maxRange) {
        const updateRanges = () => {
            let minVal = parseInt(minRange.value, 10);
            let maxVal = parseInt(maxRange.value, 10);

            if (minVal > maxVal) {
                // Evita cruce: empuja el mayor
                maxVal = minVal;
                maxRange.value = maxVal;
            }

            minLabel.textContent = `S/ ${minVal}`;
            maxLabel.textContent = `S/ ${maxVal}`;
            minInput.value = minVal;
            maxInput.value = maxVal;
        };

        minRange.addEventListener('input', updateRanges);
        maxRange.addEventListener('input', updateRanges);
        updateRanges();
    }

    // Recordar posición al enviar formularios (evita salto al top tras recarga)
    const rememberForms = document.querySelectorAll('form.remember-scroll');
    rememberForms.forEach(form => {
        form.addEventListener('submit', () => {
            sessionStorage.setItem('scrollPos', window.scrollY.toString());
        });
    });

    const savedPos = sessionStorage.getItem('scrollPos');
    if (savedPos) {
        window.scrollTo({ top: parseInt(savedPos, 10), behavior: 'auto' });
        sessionStorage.removeItem('scrollPos');
    }
});
</script>

{{-- ESTILOS ADICIONALES --}}
<style>
    .hero-slide {
        min-height: 420px;
        background-size: cover;
        background-position: center;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(27,94,32,0.65), rgba(27,94,32,0.35));
    }
    .hero-content {
        position: relative;
        padding: 80px 0;
    }
    .product-card {
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.08);
    }
    .product-image {
        height: 230px;
        overflow: hidden;
    }
    .product-icons {
        opacity: 1;
        z-index: 10;
    }
    .product-add-btn {
        opacity: 0;
        transition: opacity .25s ease;
        z-index: 10;
    }
    .product-card:hover .product-add-btn {
        opacity: 1;
    }
    .product-icons button,
    .product-icons a {
        width: 42px;
        height: 42px;
    }
    .filter-card .card-body {
        padding: 0.6rem 0.8rem !important;
    }
    .filter-card h6 {
        font-size: 0.9rem;
    }
    .filter-card .form-select,
    .filter-card .bg-light {
        min-height: 38px;
        font-size: 0.9rem;
    }
    .filter-card .bg-light {
        padding: 0.45rem;
    }
</style>

<div id="chatProductoWidget" class="position-fixed" style="bottom:20px; right:20px; z-index: 1050; display:none;">
    <div id="chatCard" class="card shadow-lg border-0" style="width: 320px; border-radius: 18px;">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-robot"></i>
                <div>
                    <div class="fw-bold small mb-0" id="chatProductoNombre">Asistente de tienda</div>
                    <small class="text-white-50">Productos, envíos, cupones</small>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-light" id="closeChat"><i class="bi bi-x"></i></button>
        </div>
        <div class="card-body" style="max-height: 360px; overflow-y: auto;">
            <div id="chatMensajes" class="d-flex flex-column gap-3 small text-muted">
                <div class="text-center text-muted small">¿Tienes dudas sobre este producto? Pregunta aquí.</div>
            </div>
        </div>
        <div class="card-footer bg-light border-0">
            <div class="d-flex gap-2 flex-wrap mb-2" id="chatSugerencias">
                <button class="btn btn-outline-success btn-sm quick-btn" data-msg="¿Qué cupones activos hay y hasta cuándo?">Cupones</button>
                <button class="btn btn-outline-success btn-sm quick-btn" data-msg="¿Qué productos tienen para cocinar?">Culinarios</button>
                <button class="btn btn-outline-success btn-sm quick-btn" data-msg="¿Tienen envíos a provincias?">Envíos</button>
            </div>
            <div class="input-group input-group-sm">
                <input type="text" id="chatInput" class="form-control" placeholder="Escribe tu pregunta..." maxlength="200">
                <button class="btn btn-success" id="enviarChat"><i class="bi bi-send"></i></button>
            </div>
            <div id="chatError" class="text-danger small mt-2 d-none"></div>
        </div>
    </div>
</div>
<button id="toggleChat" class="btn btn-success rounded-pill shadow-lg position-fixed" style="bottom:20px; left:20px; z-index:1050;">
    <i class="bi bi-chat-dots-fill me-1"></i> Asistente de tienda
</button>

<script>
    const chatEndpoint = "{{ route('store.chat.catalogo') }}";
    const chatWidget = document.getElementById('chatProductoWidget');
    const chatCard = document.getElementById('chatCard');
    const chatMensajes = document.getElementById('chatMensajes');
    const chatInput = document.getElementById('chatInput');
    const chatError = document.getElementById('chatError');
    const toggleChat = document.getElementById('toggleChat');
    const quickBtns = document.querySelectorAll('.quick-btn');

    function appendMensaje(texto, origen = 'user') {
        const bubble = document.createElement('div');
        bubble.className = origen === 'user' ? 'ms-auto bg-success text-white rounded-3 px-3 py-2' : 'bg-light rounded-3 px-3 py-2';
        bubble.style.maxWidth = '85%';
        bubble.textContent = texto;
        chatMensajes.appendChild(bubble);
        chatMensajes.scrollTop = chatMensajes.scrollHeight;
    }

    async function enviarPregunta() {
        const mensaje = chatInput.value.trim();
        chatError.classList.add('d-none');
        if (!mensaje) return;

        appendMensaje(mensaje, 'user');
        chatInput.value = '';

        try {
            const res = await fetch(chatEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ mensaje })
            });
            const data = await res.json();
            if (!data.success) {
                chatError.textContent = data.message || 'No pude responder en este momento.';
                chatError.classList.remove('d-none');
                return;
            }
            appendMensaje(data.respuesta || 'No tengo respuesta disponible.', 'bot');
        } catch (e) {
            chatError.textContent = 'Error al contactar al asistente.';
            chatError.classList.remove('d-none');
        }
    }

    toggleChat?.addEventListener('click', () => {
        chatWidget.style.display = 'block';
        chatMensajes.innerHTML = '<div class="text-center text-muted small">¿Tienes dudas sobre nuestros productos? Pregunta aquí.</div>';
        chatInput.focus();
    });

    quickBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            chatInput.value = btn.dataset.msg || '';
            enviarPregunta();
        });
    });

    document.getElementById('enviarChat')?.addEventListener('click', enviarPregunta);
    chatInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            enviarPregunta();
        }
    });

    document.getElementById('closeChat')?.addEventListener('click', () => {
        chatWidget.style.display = 'none';
    });
</script>

{{-- Favoritos y efectos --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isAuth = {{ auth()->check() ? 'true' : 'false' }};
    const loginUrl = "{{ route('auth.login.form') }}";
    const csrf = "{{ csrf_token() }}";

    document.querySelectorAll('.toggle-fav').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const productId = btn.dataset.producto;
            if (!isAuth) {
                window.location.href = loginUrl;
                return;
            }
            fetch(`{{ url('/favorito') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                const icon = btn.querySelector('i');
                if (data.favorito) {
                    icon.className = 'bi bi-heart-fill text-danger';
                } else {
                    icon.className = 'bi bi-heart text-danger';
                }
            })
            .catch(() => alert('No se pudo actualizar el favorito. Intenta nuevamente.'));
        });
    });
});
</script>
</body>
</html>
