@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Navegación superior --}}
    <div class="mb-4">
        <a href="{{ route('store.index') }}" class="btn btn-link text-decoration-none text-secondary p-0 mb-3">
            <i class="bi bi-arrow-left me-2"></i>Volver a la tienda
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Tienda</a></li>
                <li class="breadcrumb-item active">{{ $producto->categoria->nombre ?? 'Cosmética' }}</li>
            </ol>
        </nav>
    </div>

    {{-- Sección principal --}}
    <div class="row g-5 mb-5">
        {{-- Columna de imágenes --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded mb-3" alt="{{ $producto->nombre }}">
                    @else
                        <div class="bg-light border rounded mb-3 d-flex align-items-center justify-content-center" style="height:400px;">
                            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    
                    {{-- Miniaturas --}}
                    <div class="d-flex gap-2">
                        @for($i = 0; $i < 4; $i++)
                            <div class="border rounded overflow-hidden" style="width:80px;height:80px;">
                                @if($i == 0 && $producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="thumb">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        {{-- Columna de información --}}
        <div class="col-lg-7">
            <h1 class="display-5 fw-bold mb-3">{{ $producto->nombre }}</h1>
            
            {{-- Rating --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="text-warning">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < round($producto->promedio()))
                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted">{{ number_format($producto->promedio(), 1) }} ({{ $producto->resenas->count() }} reseñas)</span>
            </div>

            <p class="lead text-muted mb-4">{{ $producto->descripcion }}</p>

            <h2 class="display-4 text-success fw-bold mb-4">S/ {{ number_format($producto->precio, 2) }}</h2>

            {{-- Ingredientes destacados --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-droplet text-primary me-2"></i>Ingredientes clave
                </h6>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-flower1 text-success me-1"></i>Palta
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-moisture text-info me-1"></i>Ácido Hialurónico
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-brightness-high text-warning me-1"></i>Vitamina C
                    </span>
                </div>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $producto->id }}">

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cantidad</label>
                        <div class="input-group input-group-lg">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="{{ $producto->stock ?? 99 }}" class="form-control text-center">
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </form>

            {{-- Beneficios --}}
            <div class="card border-0 bg-light mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-stars text-warning me-2"></i>Beneficios principales
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Rejuvenece la piel visiblemente</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Reduce manchas y marcas</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Aumenta la producción de colágeno</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Ilumina el rostro</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Textura ligera de rápida absorción</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Unifica el tono de la piel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Garantías --}}
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-truck text-primary fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Envío gratis</p>
                            <p class="small text-muted mb-0">+S/ 150</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-shield-check text-success fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Seguro</p>
                            <p class="small text-muted mb-0">100%</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-arrow-counterclockwise text-info fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Devolución</p>
                            <p class="small text-muted mb-0">30 días</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-flower1 text-success fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Natural</p>
                            <p class="small text-muted mb-0">Orgánico</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs de información --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white border-0 pt-4">
            <ul class="nav nav-tabs border-0" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#modo-uso">
                        <i class="bi bi-droplet me-2"></i>Modo de Uso
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ingredientes">
                        <i class="bi bi-clipboard2-data me-2"></i>Ingredientes
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#resenas">
                        <i class="bi bi-star me-2"></i>Reseñas ({{ $producto->resenas->count() }})
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-4">
            <div class="tab-content">
                {{-- TAB 1: Modo de Uso --}}
                <div class="tab-pane fade show active" id="modo-uso">
                    <h5 class="fw-bold mb-4">¿Cómo usar este producto?</h5>
                    <p class="lead mb-4">Aplicar 3-4 gotas en rostro y cuello limpios. Usar mañana y noche antes de la crema hidratante.</p>
                    <p>Dar ligeros golpecitos con los dedos para mejor absorción.</p>
                    
                    <div class="card bg-light border-0 mt-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4">Certificaciones y Garantías</h6>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">100% Orgánico</p>
                                            <p class="small text-muted mb-0">Certificado</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-heart-fill text-danger fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Cruelty Free</p>
                                            <p class="small text-muted mb-0">No testado</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-fill-check text-primary fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Sin Parabenos</p>
                                            <p class="small text-muted mb-0">Fórmula limpia</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: Ingredientes --}}
                <div class="tab-pane fade" id="ingredientes">
                    <h5 class="fw-bold mb-4">Lista completa de ingredientes (INCI)</h5>
                    <p class="text-muted mb-4">Aqua, Persea Gratissima (Avocado) Extract*, Hyaluronic Acid, Ascorbic Acid (Vitamin C), Palmitoyl Tripeptide-5, Glycerin, Phenoxyethanol, Ethylhexylglycerin. *Ingrediente orgánico certificado.</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-flower1 text-success fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Extracto de palta</h6>
                                    <p class="small text-muted mb-0">Rico en vitaminas y antioxidantes para nutrir la piel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-moisture text-info fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Ácido hialurónico</h6>
                                    <p class="small text-muted mb-0">Hidratación profunda y efecto relleno.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-brightness-high text-warning fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Vitamina C</h6>
                                    <p class="small text-muted mb-0">Ilumina y unifica el tono de la piel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-stars text-primary fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Péptidos naturales</h6>
                                    <p class="small text-muted mb-0">Estimulan la producción de colágeno.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 3: Reseñas --}}
                <div class="tab-pane fade" id="resenas">
                    
                    {{-- Resumen --}}
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                                    <div class="display-1 fw-bold text-warning mb-2">{{ number_format($producto->promedio(), 1) }}</div>
                                    <div class="text-warning fs-4 mb-3">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < round($producto->promedio()))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-0">Basado en {{ $producto->resenas->count() }} reseñas</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body p-4">
                                    @for($i = 5; $i >= 1; $i--)
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="me-3 small fw-semibold" style="min-width: 30px;">{{ $i }} <i class="bi bi-star-fill text-warning"></i></span>
                                            <div class="progress flex-grow-1 me-3" style="height: 10px;">
                                                <div class="progress-bar bg-warning" style="width: {{ $producto->porcentajeEstrellas($i) }}%"></div>
                                            </div>
                                            <span class="small text-muted" style="min-width: 30px;">{{ $producto->cantidadEstrellas($i) }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario nueva reseña --}}
                    @auth
                        @if(!$producto->usuarioYaComento(auth()->id()))
                            <div class="card border-0 bg-light mb-5">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-4">
                                        <i class="bi bi-pencil-square me-2"></i>Escribe tu reseña
                                    </h5>

                                    <form action="{{ route('resenas.store', $producto->id) }}" method="POST">
                                        @csrf

                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Tu calificación</label>
                                                <select name="puntuacion" class="form-select form-select-lg" required>
                                                    <option value="">Selecciona</option>
                                                    <option value="5"><i class="bi bi-star-fill"></i> 5 - Excelente</option>
                                                    <option value="4">4 - Muy bueno</option>
                                                    <option value="3">3 - Bueno</option>
                                                    <option value="2">2 - Regular</option>
                                                    <option value="1">1 - Malo</option>
                                                </select>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label fw-semibold">Tu opinión</label>
                                                <textarea name="comentario" rows="4" class="form-control form-control-lg" placeholder="Comparte tu experiencia con este producto..." required></textarea>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-success btn-lg px-5">
                                                <i class="bi bi-send me-2"></i>Publicar reseña
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success border-0 mb-5">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <strong>¡Gracias!</strong> Ya has dejado tu reseña para este producto.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning border-0 mb-5">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Inicia sesión</strong> para compartir tu opinión. 
                            <a href="{{ route('login') }}" class="alert-link fw-bold">Iniciar sesión aquí</a>
                        </div>
                    @endauth

                    {{-- Lista de reseñas --}}
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-chat-left-quote me-2"></i>Lo que dicen nuestros clientes
                    </h5>

                    @forelse($producto->resenas as $resena)
                        <div class="card border shadow-sm mb-3">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    {{-- Avatar --}}
                                    <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center text-white fw-bold me-3" 
                                         style="width: 50px; height: 50px; flex-shrink: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        {{ strtoupper(substr($resena->usuario->name, 0, 1)) }}
                                    </div>

                                    <div class="flex-grow-1">
                                        {{-- Header --}}
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $resena->usuario->name }}</h6>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="text-warning">
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($i < $resena->puntuacion)
                                                                <i class="bi bi-star-fill"></i>
                                                            @else
                                                                <i class="bi bi-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <small class="text-muted">{{ $resena->created_at->locale('es')->diffForHumans() }}</small>
                                                </div>
                                            </div>

                                            {{-- Badge verificado --}}
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill">
                                                <i class="bi bi-patch-check-fill me-1"></i>Compra verificada
                                            </span>
                                        </div>

                                        {{-- Comentario --}}
                                        <p class="mb-3">{{ $resena->comentario }}</p>

                                        {{-- Acciones --}}
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-hand-thumbs-up me-1"></i>Útil (0)
                                            </button>
                                            
                                            @auth
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalReportar{{ $resena->id }}">
                                                    <i class="bi bi-flag me-1"></i>Reportar
                                                </button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Reportar --}}
                        @auth
                            <div class="modal fade" id="modalReportar{{ $resena->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">
                                                <i class="bi bi-flag-fill text-danger me-2"></i>Reportar reseña
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('resenas.reportar', $resena->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body p-4">
                                                <p class="text-muted mb-3">¿Por qué deseas reportar esta reseña?</p>

                                                <select class="form-select mb-3" id="motivoRapido{{ $resena->id }}"
                                                        onchange="document.getElementById('motivoTexto{{ $resena->id }}').value = this.value;">
                                                    <option value="">Seleccionar motivo</option>
                                                    <option value="Contenido ofensivo o inapropiado">Contenido ofensivo o inapropiado</option>
                                                    <option value="Lenguaje vulgar o discriminatorio">Lenguaje vulgar o discriminatorio</option>
                                                    <option value="Información falsa o engañosa">Información falsa o engañosa</option>
                                                    <option value="Spam o contenido publicitario">Spam o contenido publicitario</option>
                                                    <option value="Acoso o intimidación">Acoso o intimidación</option>
                                                </select>

                                                <textarea id="motivoTexto{{ $resena->id }}"
                                                          name="motivo"
                                                          class="form-control"
                                                          rows="4"
                                                          placeholder="Describe con más detalle el motivo del reporte (opcional)"
                                                          required></textarea>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-send me-1"></i>Enviar reporte
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-chat-left-quote text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-3 mb-2">Aún no hay reseñas para este producto.</p>
                            <p class="text-muted">¡Sé el primero en compartir tu opinión!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function increaseQty() {
    let input = document.getElementById('cantidad');
    let max = parseInt(input.getAttribute('max'));
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decreaseQty() {
    let input = document.getElementById('cantidad');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
@endsection@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Navegación superior --}}
    <div class="mb-4">
        <a href="{{ route('store.index') }}" class="btn btn-link text-decoration-none text-secondary p-0 mb-3">
            <i class="bi bi-arrow-left me-2"></i>Volver a la tienda
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Tienda</a></li>
                <li class="breadcrumb-item active">{{ $producto->categoria->nombre ?? 'Cosmética' }}</li>
            </ol>
        </nav>
    </div>

    {{-- Sección principal --}}
    <div class="row g-5 mb-5">
        {{-- Columna de imágenes --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded mb-3" alt="{{ $producto->nombre }}">
                    @else
                        <div class="bg-light border rounded mb-3 d-flex align-items-center justify-content-center" style="height:400px;">
                            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                    
                    {{-- Miniaturas --}}
                    <div class="d-flex gap-2">
                        @for($i = 0; $i < 4; $i++)
                            <div class="border rounded overflow-hidden" style="width:80px;height:80px;">
                                @if($i == 0 && $producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="thumb">
                                @else
                                    <div class="bg-light h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        {{-- Columna de información --}}
        <div class="col-lg-7">
            <h1 class="display-5 fw-bold mb-3">{{ $producto->nombre }}</h1>
            
            {{-- Rating --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="text-warning">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < round($producto->promedio()))
                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted">{{ number_format($producto->promedio(), 1) }} ({{ $producto->resenas->count() }} reseñas)</span>
            </div>

            <p class="lead text-muted mb-4">{{ $producto->descripcion }}</p>

            <h2 class="display-4 text-success fw-bold mb-4">S/ {{ number_format($producto->precio, 2) }}</h2>

            {{-- Ingredientes destacados --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-droplet text-primary me-2"></i>Ingredientes clave
                </h6>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-flower1 text-success me-1"></i>Palta
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-moisture text-info me-1"></i>Ácido Hialurónico
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-brightness-high text-warning me-1"></i>Vitamina C
                    </span>
                </div>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $producto->id }}">

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Cantidad</label>
                        <div class="input-group input-group-lg">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="{{ $producto->stock ?? 99 }}" class="form-control text-center">
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </form>

            {{-- Beneficios --}}
            <div class="card border-0 bg-light mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-stars text-warning me-2"></i>Beneficios principales
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Rejuvenece la piel visiblemente</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Reduce manchas y marcas</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Aumenta la producción de colágeno</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Ilumina el rostro</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Textura ligera de rápida absorción</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span class="small">Unifica el tono de la piel</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Garantías --}}
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-truck text-primary fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Envío gratis</p>
                            <p class="small text-muted mb-0">+S/ 150</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-shield-check text-success fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Seguro</p>
                            <p class="small text-muted mb-0">100%</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-arrow-counterclockwise text-info fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Devolución</p>
                            <p class="small text-muted mb-0">30 días</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-flower1 text-success fs-3 mb-2"></i>
                            <p class="small fw-semibold mb-1">Natural</p>
                            <p class="small text-muted mb-0">Orgánico</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs de información --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white border-0 pt-4">
            <ul class="nav nav-tabs border-0" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#modo-uso">
                        <i class="bi bi-droplet me-2"></i>Modo de Uso
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ingredientes">
                        <i class="bi bi-clipboard2-data me-2"></i>Ingredientes
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#resenas">
                        <i class="bi bi-star me-2"></i>Reseñas ({{ $producto->resenas->count() }})
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-4">
            <div class="tab-content">
                {{-- TAB 1: Modo de Uso --}}
                <div class="tab-pane fade show active" id="modo-uso">
                    <h5 class="fw-bold mb-4">¿Cómo usar este producto?</h5>
                    <p class="lead mb-4">Aplicar 3-4 gotas en rostro y cuello limpios. Usar mañana y noche antes de la crema hidratante.</p>
                    <p>Dar ligeros golpecitos con los dedos para mejor absorción.</p>
                    
                    <div class="card bg-light border-0 mt-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-4">Certificaciones y Garantías</h6>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-patch-check-fill text-success fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">100% Orgánico</p>
                                            <p class="small text-muted mb-0">Certificado</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-heart-fill text-danger fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Cruelty Free</p>
                                            <p class="small text-muted mb-0">No testado</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-fill-check text-primary fs-3 me-3"></i>
                                        <div>
                                            <p class="fw-bold mb-0">Sin Parabenos</p>
                                            <p class="small text-muted mb-0">Fórmula limpia</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 2: Ingredientes --}}
                <div class="tab-pane fade" id="ingredientes">
                    <h5 class="fw-bold mb-4">Lista completa de ingredientes (INCI)</h5>
                    <p class="text-muted mb-4">Aqua, Persea Gratissima (Avocado) Extract*, Hyaluronic Acid, Ascorbic Acid (Vitamin C), Palmitoyl Tripeptide-5, Glycerin, Phenoxyethanol, Ethylhexylglycerin. *Ingrediente orgánico certificado.</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-flower1 text-success fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Extracto de palta</h6>
                                    <p class="small text-muted mb-0">Rico en vitaminas y antioxidantes para nutrir la piel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-moisture text-info fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Ácido hialurónico</h6>
                                    <p class="small text-muted mb-0">Hidratación profunda y efecto relleno.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-brightness-high text-warning fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Vitamina C</h6>
                                    <p class="small text-muted mb-0">Ilumina y unifica el tono de la piel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border h-100">
                                <div class="card-body">
                                    <i class="bi bi-stars text-primary fs-3 mb-3"></i>
                                    <h6 class="fw-bold mb-2">Péptidos naturales</h6>
                                    <p class="small text-muted mb-0">Estimulan la producción de colágeno.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB 3: Reseñas --}}
                <div class="tab-pane fade" id="resenas">
                    
                    {{-- Resumen --}}
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                                    <div class="display-1 fw-bold text-warning mb-2">{{ number_format($producto->promedio(), 1) }}</div>
                                    <div class="text-warning fs-4 mb-3">
                                        @for($i = 0; $i < 5; $i++)
                                            @if($i < round($producto->promedio()))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-0">Basado en {{ $producto->resenas->count() }} reseñas</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body p-4">
                                    @for($i = 5; $i >= 1; $i--)
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="me-3 small fw-semibold" style="min-width: 30px;">{{ $i }} <i class="bi bi-star-fill text-warning"></i></span>
                                            <div class="progress flex-grow-1 me-3" style="height: 10px;">
                                                <div class="progress-bar bg-warning" style="width: {{ $producto->porcentajeEstrellas($i) }}%"></div>
                                            </div>
                                            <span class="small text-muted" style="min-width: 30px;">{{ $producto->cantidadEstrellas($i) }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario nueva reseña --}}
                    @auth
                        @if(!$producto->usuarioYaComento(auth()->id()))
                            <div class="card border-0 bg-light mb-5">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-4">
                                        <i class="bi bi-pencil-square me-2"></i>Escribe tu reseña
                                    </h5>

                                    <form action="{{ route('resenas.store', $producto->id) }}" method="POST">
                                        @csrf

                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Tu calificación</label>
                                                <select name="puntuacion" class="form-select form-select-lg" required>
                                                    <option value="">Selecciona</option>
                                                    <option value="5"><i class="bi bi-star-fill"></i> 5 - Excelente</option>
                                                    <option value="4">4 - Muy bueno</option>
                                                    <option value="3">3 - Bueno</option>
                                                    <option value="2">2 - Regular</option>
                                                    <option value="1">1 - Malo</option>
                                                </select>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label fw-semibold">Tu opinión</label>
                                                <textarea name="comentario" rows="4" class="form-control form-control-lg" placeholder="Comparte tu experiencia con este producto..." required></textarea>
                                            </div>
                                        </div>

                                        <div class="text-end mt-4">
                                            <button type="submit" class="btn btn-success btn-lg px-5">
                                                <i class="bi bi-send me-2"></i>Publicar reseña
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success border-0 mb-5">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <strong>¡Gracias!</strong> Ya has dejado tu reseña para este producto.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning border-0 mb-5">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Inicia sesión</strong> para compartir tu opinión. 
                            <a href="{{ route('login') }}" class="alert-link fw-bold">Iniciar sesión aquí</a>
                        </div>
                    @endauth

                    {{-- Lista de reseñas --}}
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-chat-left-quote me-2"></i>Lo que dicen nuestros clientes
                    </h5>

                    @forelse($producto->resenas as $resena)
                        <div class="card border shadow-sm mb-3">
                            <div class="card-body p-4">
                                <div class="d-flex">
                                    {{-- Avatar --}}
                                    <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center text-white fw-bold me-3" 
                                         style="width: 50px; height: 50px; flex-shrink: 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        {{ strtoupper(substr($resena->usuario->name, 0, 1)) }}
                                    </div>

                                    <div class="flex-grow-1">
                                        {{-- Header --}}
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $resena->usuario->name }}</h6>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="text-warning">
                                                        @for($i = 0; $i < 5; $i++)
                                                            @if($i < $resena->puntuacion)
                                                                <i class="bi bi-star-fill"></i>
                                                            @else
                                                                <i class="bi bi-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <small class="text-muted">{{ $resena->created_at->locale('es')->diffForHumans() }}</small>
                                                </div>
                                            </div>

                                            {{-- Badge verificado --}}
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill">
                                                <i class="bi bi-patch-check-fill me-1"></i>Compra verificada
                                            </span>
                                        </div>

                                        {{-- Comentario --}}
                                        <p class="mb-3">{{ $resena->comentario }}</p>

                                        {{-- Acciones --}}
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-hand-thumbs-up me-1"></i>Útil (0)
                                            </button>
                                            
                                            @auth
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalReportar{{ $resena->id }}">
                                                    <i class="bi bi-flag me-1"></i>Reportar
                                                </button>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Reportar --}}
                        @auth
                            <div class="modal fade" id="modalReportar{{ $resena->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold">
                                                <i class="bi bi-flag-fill text-danger me-2"></i>Reportar reseña
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('resenas.reportar', $resena->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body p-4">
                                                <p class="text-muted mb-3">¿Por qué deseas reportar esta reseña?</p>

                                                <select class="form-select mb-3" id="motivoRapido{{ $resena->id }}"
                                                        onchange="document.getElementById('motivoTexto{{ $resena->id }}').value = this.value;">
                                                    <option value="">Seleccionar motivo</option>
                                                    <option value="Contenido ofensivo o inapropiado">Contenido ofensivo o inapropiado</option>
                                                    <option value="Lenguaje vulgar o discriminatorio">Lenguaje vulgar o discriminatorio</option>
                                                    <option value="Información falsa o engañosa">Información falsa o engañosa</option>
                                                    <option value="Spam o contenido publicitario">Spam o contenido publicitario</option>
                                                    <option value="Acoso o intimidación">Acoso o intimidación</option>
                                                </select>

                                                <textarea id="motivoTexto{{ $resena->id }}"
                                                          name="motivo"
                                                          class="form-control"
                                                          rows="4"
                                                          placeholder="Describe con más detalle el motivo del reporte (opcional)"
                                                          required></textarea>
                                            </div>

                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-send me-1"></i>Enviar reporte
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-chat-left-quote text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-3 mb-2">Aún no hay reseñas para este producto.</p>
                            <p class="text-muted">¡Sé el primero en compartir tu opinión!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function increaseQty() {
    let input = document.getElementById('cantidad');
    let max = parseInt(input.getAttribute('max'));
    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decreaseQty() {
    let input = document.getElementById('cantidad');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
@endsection