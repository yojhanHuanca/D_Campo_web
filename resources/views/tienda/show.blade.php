<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }} - D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    {{-- Breadcrumb / Back --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('store.index') }}" class="btn btn-link text-decoration-none text-success px-0">
            <i class="bi bi-arrow-left me-2"></i>Volver a la tienda
        </a>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a class="text-decoration-none text-muted" href="{{ route('store.index') }}">Tienda</a></li>
                <li class="breadcrumb-item active text-success" aria-current="page">{{ $producto->categoria->nombre ?? 'Cosmética' }}</li>
            </ol>
        </nav>
    </div>

    {{-- Hero --}}
    <div class="p-4 p-lg-5 mb-4 rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(120deg, #e8f5e9, #f5fff5);">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-success text-white"><i class="bi bi-flower1 me-1"></i>Natural</span>
                    <span class="badge bg-white text-success border border-success"><i class="bi bi-truck me-1"></i>Envío rápido</span>
                </div>
                <h1 class="display-5 fw-bold text-success mb-2">{{ $producto->nombre }}</h1>
                <p class="text-muted lead mb-3">{{ Str::limit($producto->descripcion, 140) }}</p>
                <div class="d-flex align-items-center gap-3">
                    @php
                        $promedio = $producto->resenas->avg('puntuacion') ?? 0;
                        $totalResenas = $producto->resenas->count();
                    @endphp
                    <div class="text-warning">
                        @for($i = 0; $i < 5; $i++)
                            <i class="bi bi-star{{ $i < round($promedio) ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <span class="fw-semibold text-dark">{{ number_format($promedio, 1) }}</span>
                    <a href="#tab-resenas" class="text-decoration-none small">({{ $totalResenas }} reseñas)</a>
                </div>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                @if(($producto->stock ?? 0) > 0)
                    <span class="badge bg-success-subtle text-success mb-2">Stock: {{ $producto->stock ?? 0 }}</span>
                @else
                    <span class="badge bg-danger bg-opacity-10 text-danger mb-2">Agotado</span>
                @endif
                <h2 class="fw-bold text-success mb-2">S/ {{ number_format($producto->precio, 2) }}</h2>
                <p class="text-muted small mb-3"><i class="bi bi-shield-check me-1 text-success"></i>Pago seguro · Devolución 30 días</p>
            </div>
        </div>
    </div>

    {{-- Main layout --}}
    <div class="row g-4 mb-5">

        {{-- Galería --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top rounded-4" alt="{{ $producto->nombre }}" style="height: 480px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded-4" style="height: 480px;">
                        <i class="bi bi-image text-muted display-1"></i>
                    </div>
                @endif
            </div>
            <div class="row g-2">
                @for($i = 0; $i < 4; $i++)
                    <div class="col-3">
                        <div class="card border-0 shadow-sm rounded-3" style="height: 80px; overflow: hidden;">
                            @if($i == 0 && $producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="h-100 w-100" style="object-fit: cover;" alt="thumb">
                            @else
                                <div class="bg-light h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Info / CTA --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-success text-white">Disponible</span>
                        <span class="badge bg-success-subtle text-success">+10 vendidos hoy</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <small class="text-muted d-block">Precio</small>
                            <h3 class="fw-bold text-success mb-0">S/ {{ number_format($producto->precio, 2) }}</h3>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Envío</small>
                            <span class="badge bg-white text-success border"><i class="bi bi-box-seam me-1"></i>Gratis desde S/150</span>
                        </div>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $producto->id }}">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-muted">Cantidad</label>
                                <div class="input-group input-group-lg">
                                    <button class="btn btn-outline-success" type="button" onclick="let i=this.nextElementSibling; if(i.value>1) i.value=parseInt(i.value)-1;">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock ?? 99 }}" class="form-control text-center">
                                    <button class="btn btn-outline-success" type="button" onclick="let i=this.previousElementSibling; if(i.value<i.max) i.value=parseInt(i.value)+1;">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-muted">Disponibilidad</label>
                                <div class="p-3 bg-light rounded-3 border text-success fw-semibold">
                                    <i class="bi bi-check-circle me-1"></i>En stock ({{ $producto->stock ?? 0 }})
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            @if(($producto->stock ?? 0) > 0)
                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">
                                    <i class="bi bi-cart-plus me-2"></i>Agregar al carrito
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary btn-lg rounded-pill shadow-sm disabled">
                                    <i class="bi bi-x-circle me-2"></i>Sin stock
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-success rounded-pill toggle-fav" data-url="{{ route('favorito.toggle', $producto->id) }}">
                                <i class="bi bi-heart me-2"></i>Agregar a favoritos
                            </button>
                        </div>
                    </form>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <i class="bi bi-patch-check-fill text-success fs-4 mb-1 d-block"></i>
                                <p class="mb-0 small text-muted">Fórmula certificada orgánica</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <i class="bi bi-droplet-half text-success fs-4 mb-1 d-block"></i>
                                <p class="mb-0 small text-muted">Hidratación 24h sin parabenos</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <i class="bi bi-box-seam text-success fs-4 mb-1 d-block"></i>
                                <p class="mb-0 small text-muted">Entregas en 24-48h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs info --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 px-4 pt-4">
            <ul class="nav nav-pills gap-2">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-descripcion">
                        <i class="bi bi-file-text me-1"></i>Descripción
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ingredientes">
                        <i class="bi bi-droplet me-1"></i>Ingredientes
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-resenas">
                        <i class="bi bi-star me-1"></i>Reseñas ({{ $totalResenas }})
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body p-4">
            <div class="tab-content">
                {{-- Descripción --}}
                <div class="tab-pane fade show active" id="tab-descripcion">
                    <h5 class="fw-bold mb-3 text-success">Por qué funciona</h5>
                    <p class="text-muted mb-4">
                        Los productos a base de palta de D'Campo están elaborados con ingredientes naturales que aprovechan sus propiedades nutritivas.
                        Gracias a su riqueza en vitaminas, antioxidantes y aceites esenciales, brindan hidratación profunda, suavidad y protección para la piel.
                    </p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 text-center">
                                <i class="bi bi-brightness-high text-warning fs-3 d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Ilumina</h6>
                                <p class="small text-muted mb-0">Mejora el tono y la textura.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 text-center">
                                <i class="bi bi-shield-check text-success fs-3 d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Protege</h6>
                                <p class="small text-muted mb-0">Antioxidantes contra el estrés ambiental.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-3 h-100 text-center">
                                <i class="bi bi-droplet text-primary fs-3 d-block mb-2"></i>
                                <h6 class="fw-bold mb-1">Hidrata</h6>
                                <p class="small text-muted mb-0">Nutrición profunda sin sensación grasa.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ingredientes --}}
                <div class="tab-pane fade" id="tab-ingredientes">
                    <h5 class="fw-bold mb-3 text-success">Ingredientes activos</h5>
                    <p class="text-muted small mb-4">Aqua, Persea Gratissima (Avocado) Extract*, Hyaluronic Acid, Ascorbic Acid (Vitamin C), Palmitoyl Tripeptide-5.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-white text-success p-2 me-2">
                                        <i class="bi bi-flower1"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 small">Extracto de Palta</h6>
                                </div>
                                <p class="small text-muted mb-0">Rico en vitaminas que nutren y suavizan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-white text-success p-2 me-2">
                                        <i class="bi bi-moisture"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 small">Ácido Hialurónico</h6>
                                </div>
                                <p class="small text-muted mb-0">Retiene agua y mejora la elasticidad.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-white text-success p-2 me-2">
                                        <i class="bi bi-brightness-high"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 small">Vitamina C</h6>
                                </div>
                                <p class="small text-muted mb-0">Ilumina y unifica el tono.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded-3 h-100">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle bg-white text-success p-2 me-2">
                                        <i class="bi bi-stars"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0 small">Péptidos</h6>
                                </div>
                                <p class="small text-muted mb-0">Estimulan el colágeno y firmeza.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Reseñas --}}
                <div class="tab-pane fade" id="tab-resenas">
                    <div id="seccion-resenas">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="p-4 bg-success bg-opacity-10 rounded-3 text-center h-100">
                                    <div class="display-4 fw-bold text-success">{{ number_format($promedio, 1) }}</div>
                                    <div class="text-warning fs-5 my-2">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="bi bi-star{{ $i < round($promedio) ? '-fill' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="small text-muted mb-0">{{ $totalResenas }} opiniones</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <h6 class="fw-bold mb-3 small">Distribución</h6>
                                    @for($i = 5; $i >= 1; $i--)
                                        @php
                                            $cant = $producto->resenas->where('puntuacion', $i)->count();
                                            $porc = $totalResenas > 0 ? ($cant / $totalResenas) * 100 : 0;
                                        @endphp
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="small me-2" style="min-width:45px;">{{ $i }} <i class="bi bi-star-fill text-warning"></i></span>
                                            <div class="progress flex-grow-1 me-2" style="height:8px;">
                                                <div class="progress-bar bg-warning" style="width:{{ $porc }}%"></div>
                                            </div>
                                            <span class="small text-muted" style="min-width:30px;">{{ $cant }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        {{-- Formulario reseña --}}
                        @auth
                            @php
                                $yaComento = $producto->resenas->where('usuario_id', auth()->id())->first();
                            @endphp
                            @if(!$yaComento)
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="bi bi-pencil me-1"></i>Escribe tu reseña</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <form action="{{ route('resenas.store', $producto->id) }}" method="POST">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold small">Calificación</label>
                                                    <select name="puntuacion" class="form-select" required>
                                                        <option value="">Selecciona</option>
                                                        <option value="5">5 - Excelente</option>
                                                        <option value="4">4 - Muy bueno</option>
                                                        <option value="3">3 - Bueno</option>
                                                        <option value="2">2 - Regular</option>
                                                        <option value="1">1 - Malo</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="form-label fw-semibold small">Tu opinión</label>
                                                    <textarea name="comentario" rows="3" class="form-control" placeholder="Comparte tu experiencia..." required></textarea>
                                                </div>
                                            </div>
                                            <div class="text-end mt-3">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-send me-1"></i>Publicar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle me-1"></i>¡Gracias por tu opinión!
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                <a href="{{ route('login') }}" class="alert-link">Inicia sesión</a> para dejar tu reseña.
                            </div>
                        @endauth

                        {{-- Lista --}}
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-chat-quote text-success me-1"></i>Opiniones verificadas
                        </h6>
                        <div style="max-height:600px; overflow-y:auto;">
                            @forelse($producto->resenas as $resena)
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body p-3">
                                        <div class="d-flex">
                                            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bold me-3"
                                                 style="width:48px; height:48px; flex-shrink:0;">
                                                {{ strtoupper(substr($resena->usuario->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold mb-1 small">{{ $resena->usuario->name }}</h6>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="text-warning small">
                                                                @for($i = 0; $i < 5; $i++)
                                                                    <i class="bi bi-star{{ $i < $resena->puntuacion ? '-fill' : '' }}"></i>
                                                                @endfor
                                                            </div>
                                                            <span class="text-muted small">{{ $resena->created_at->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <span class="badge bg-success-subtle text-success border border-success small">
                                                        <i class="bi bi-patch-check me-1"></i>Verificada
                                                    </span>
                                                </div>
                                                <p class="mb-2 small">{{ $resena->comentario }}</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-hand-thumbs-up me-1"></i>Útil
                                                    </button>
                                                    @auth
                                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $resena->id }}">
                                                            <i class="bi bi-flag me-1"></i>Reportar
                                                        </button>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @auth
                                    <div class="modal fade" id="modal{{ $resena->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h6 class="modal-title"><i class="bi bi-flag me-1"></i>Reportar reseña</h6>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('resenas.reportar', $resena->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="fw-semibold small">¿Por qué reportas esta reseña?</p>
                                                        <select class="form-select mb-3" id="sel{{ $resena->id }}"
                                                                onchange="document.getElementById('txt{{ $resena->id }}').value = this.value;">
                                                            <option value="">Selecciona</option>
                                                            <option value="Contenido ofensivo">Contenido ofensivo</option>
                                                            <option value="Lenguaje inapropiado">Lenguaje inapropiado</option>
                                                            <option value="Información falsa">Información falsa</option>
                                                            <option value="Spam">Spam</option>
                                                        </select>
                                                        <textarea id="txt{{ $resena->id }}" name="motivo" class="form-control" rows="3" placeholder="Describe el motivo" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-send me-1"></i>Enviar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-chat-quote text-muted" style="font-size:4rem;"></i>
                                    <p class="text-muted mt-3">Aún no hay reseñas</p>
                                    <p class="text-muted small">¡Sé el primero en opinar!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.toggle-fav').forEach(btn => {
    btn.addEventListener('click', () => {
        let url = btn.dataset.url;
        fetch(url, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.favorito === true) {
                btn.classList.remove('btn-outline-success');
                btn.classList.add('btn-success');
                btn.innerHTML = `<i class="bi bi-heart-fill me-2"></i> Favorito`;
            } else {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-success');
                btn.innerHTML = `<i class="bi bi-heart me-2"></i> Agregar a favoritos`;
            }
        });
    });
});
</script>

<style>
    body { background: #f7f9f7; }
    .nav-pills .nav-link {
        border-radius: 50px;
    }
    .nav-pills .nav-link.active {
        background: #2e7d32;
    }
    .card {
        border-radius: 18px;
    }
    .rounded-4 { border-radius: 18px!important; }
</style>

</body>
</html>
