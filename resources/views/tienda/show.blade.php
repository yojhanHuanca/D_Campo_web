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
            <div class="card border-0 shadow-sm mb-3">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top rounded" alt="{{ $producto->nombre }}" style="height: 450px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 450px;">
                        <i class="bi bi-image text-muted display-1"></i>
                    </div>
                @endif
            </div>
            
            <div class="row g-2">
                @for($i = 0; $i < 3; $i++)
                    <div class="col-3">
                        <div class="card border shadow-sm" style="height: 90px; overflow: hidden;">
                            @if($i == 0 && $producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img h-100" style="object-fit: cover;" alt="thumb">
                            @else
                                <div class="card-body d-flex align-items-center justify-content-center bg-light h-100 p-0">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Columna Derecha: Info --}}
        <div class="col-lg-7">
            
            <h1 class="h2 fw-bold mb-3">{{ $producto->nombre }}</h1>
            
            @php
                $promedio = $producto->resenas->avg('puntuacion') ?? 0;
                $totalResenas = $producto->resenas->count();
            @endphp
            
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="text-warning">
                    @for($i = 0; $i < 5; $i++)
                        <i class="bi bi-star{{ $i < round($promedio) ? '-fill' : '' }}"></i>
                    @endfor
                </div>
                <span class="text-muted">{{ number_format($promedio, 1) }}</span>
                <a href="#seccion-resenas" class="text-decoration-none small">({{ $totalResenas }} opiniones)</a>
            </div>

            <p class="text-muted mb-4">{{ $producto->descripcion }}</p>

            <div class="card bg-success bg-opacity-10 border-0 mb-4">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Precio</small>
                            <h3 class="text-success fw-bold mb-0">S/ {{ number_format($producto->precio, 2) }}</h3>
                        </div>
                        <span class="badge bg-success">
                            <i class="bi bi-truck me-1"></i>Envío gratis +S/150
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $producto->id }}">

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Cantidad</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" onclick="let input=this.nextElementSibling; if(input.value>1) input.value=parseInt(input.value)-1;">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock ?? 99 }}" class="form-control text-center">
                            <button class="btn btn-outline-secondary" type="button" onclick="let input=this.previousElementSibling; if(input.value<input.max) input.value=parseInt(input.value)+1;">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-semibold small">Disponibilidad</label>
                        <div class="p-2 bg-light rounded border">
                            <i class="bi bi-check-circle-fill text-success me-1"></i>
                            <span class="small">En stock ({{ $producto->stock ?? 99 }} unidades)</span>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-cart-plus me-2"></i>Agregar al carrito
                    </button>
                    <button type="button"
                            class="btn btn-outline-success btn-sm toggle-fav"
                            data-url="{{ route('favorito.toggle', $producto->id) }}">
                        <i class="bi bi-heart me-2"></i>Agregar a favoritos
                    </button>
                </div>
            </form>

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-3 small">
                        <i class="bi bi-check-circle text-success me-1"></i>Beneficios principales
                    </h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <small><i class="bi bi-check2 text-success me-1"></i>Rejuvenece la piel</small>
                        </div>
                        <div class="col-6">
                            <small><i class="bi bi-check2 text-success me-1"></i>Ilumina el rostro</small>
                        </div>
                        <div class="col-6">
                            <small><i class="bi bi-check2 text-success me-1"></i>Reduce manchas</small>
                        </div>
                        <div class="col-6">
                            <small><i class="bi bi-check2 text-success me-1"></i>Rápida absorción</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                            <p class="small mb-0 mt-1">Compra Segura</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-3">
                            <i class="bi bi-arrow-repeat text-success fs-4"></i>
                            <p class="small mb-0 mt-1">Devolución 30d</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white pt-3">
            <ul class="nav nav-tabs card-header-tabs">
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


                {{-- TAB Descripción --}}
                <div class="tab-pane fade show active" id="tab-descripcion">
                    <h5 class="fw-bold mb-3">Modo de uso</h5>
                    <p class="mb-3">Aplicar 3-4 gotas en rostro y cuello limpios. Usar mañana y noche antes de la crema hidratante.</p>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="card border h-100">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-patch-check-fill text-success fs-2 mb-2"></i>
                                    <h6 class="fw-bold small">100% Orgánico</h6>
                                    <p class="small text-muted mb-0">Certificado</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border h-100">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-heart-fill text-danger fs-2 mb-2"></i>
                                    <h6 class="fw-bold small">Cruelty Free</h6>
                                    <p class="small text-muted mb-0">No testado</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border h-100">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-shield-fill-check text-primary fs-2 mb-2"></i>
                                    <h6 class="fw-bold small">Sin Parabenos</h6>
                                    <p class="small text-muted mb-0">Fórmula limpia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB Ingredientes --}}
                <div class="tab-pane fade" id="tab-ingredientes">
                    <h5 class="fw-bold mb-3">Ingredientes activos</h5>
                    <p class="text-muted mb-4 small">Aqua, Persea Gratissima (Avocado) Extract*, Hyaluronic Acid, Ascorbic Acid (Vitamin C), Palmitoyl Tripeptide-5.</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-2 me-2">
                                            <i class="bi bi-flower1 text-success fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 small">Extracto de Palta</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Rico en vitaminas que nutren la piel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-circle bg-info bg-opacity-10 p-2 me-2">
                                            <i class="bi bi-moisture text-info fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 small">Ácido Hialurónico</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Hidratación profunda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-2">
                                            <i class="bi bi-brightness-high text-warning fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 small">Vitamina C</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Ilumina y unifica el tono.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                            <i class="bi bi-stars text-primary fs-5"></i>
                                        </div>
                                        <h6 class="fw-bold mb-0 small">Péptidos</h6>
                                    </div>
                                    <p class="small text-muted mb-0">Estimulan el colágeno.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB Reseñas --}}
                <div class="tab-pane fade" id="tab-resenas">
                    <div id="seccion-resenas">

                        {{-- Resumen --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card bg-success bg-opacity-10 border-0">
                                    <div class="card-body text-center p-4">
                                        <div class="display-4 fw-bold text-success">{{ number_format($promedio, 1) }}</div>
                                        <div class="text-warning fs-5 my-2">
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="bi bi-star{{ $i < round($promedio) ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="small text-muted mb-0">{{ $totalResenas }} opiniones</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
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
                        </div>

                        {{-- Formulario --}}
                        @auth
                            @php
                                $yaComento = $producto->resenas->where('usuario_id', auth()->id())->first();
                            @endphp
                            @if(!$yaComento)
                                <div class="card border-success mb-4">
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
                                <div class="card border shadow-sm mb-3">
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

                                {{-- Modal --}}
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
@endsection

@push('scripts')
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
