@extends('layouts.perfil')

@section('content')
<div class="container py-4">
    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            @include('perfil.sidebar')
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="col-md-9">

            {{-- ENCABEZADO --}}
            <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-2 d-flex align-items-center gap-2">
                            <i class="bi bi-heart-fill text-success"></i>
                            Mis Favoritos
                        </h3>
                        <p class="text-muted mb-0">Productos que amas y quieres guardar</p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success bg-opacity-10 text-success fs-5 px-4 py-2 rounded-pill">
                            {{ $favoritos->count() }} {{ $favoritos->count() == 1 ? 'producto' : 'productos' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- LISTADO DE FAVORITOS EN GRID --}}
            <div class="row g-3">
                @forelse ($favoritos as $fav)

                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-card">
                            
                            {{-- Barra superior decorativa --}}
                            <div class="bg-success" style="height: 4px;"></div>

                            <div class="card-body p-3 d-flex flex-column">
                                
                                {{-- Imagen del Producto --}}
                                <div class="text-center mb-3">
                                    @if($fav->producto->imagen)
                                        <img src="{{ asset('storage/' . $fav->producto->imagen) }}"
                                             alt="{{ $fav->producto->nombre }}"
                                             class="rounded-3 object-fit-cover shadow-sm w-100"
                                             style="height: 40px;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center shadow-sm w-100"
                                             style="height: 40px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Información del Producto --}}
                                <div class="mb-3">
                                    <h5 class="fw-bold mb-2">{{ $fav->producto->nombre }}</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="text-success fw-bold fs-4">
                                            S/ {{ number_format($fav->producto->precio, 2) }}
                                        </span>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-check-circle-fill me-1"></i>Disponible
                                        </span>
                                    </div>
                                </div>

                                {{-- Acciones --}}
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('store.show', $fav->producto->id) }}" 
                                           class="btn btn-success rounded-pill">
                                            <i class="bi bi-eye me-2"></i>Ver producto
                                        </a>
                                        <button class="btn btn-outline-danger rounded-pill remove-fav"
                                                data-id="{{ $fav->producto->id }}">
                                            <i class="bi bi-heart-fill me-2"></i>Quitar de favoritos
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty

                <div class="col-12">
                    {{-- ESTADO VACÍO --}}
                    <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <i class="bi bi-heart text-success opacity-25" style="font-size: 6rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">No tienes productos favoritos</h4>
                        <p class="text-muted mb-4 fs-5">
                            Explora nuestra tienda y guarda tus productos preferidos.<br>
                            ¡Descubre la belleza natural de D'Campo!
                        </p>

                        <a href="{{ route('store.index') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3">
                            <i class="bi bi-shop me-2"></i>Explorar tienda
                        </a>
                    </div>
                </div>

            @endforelse

            {{-- MENSAJE INFORMATIVO --}}
            <div class="card border-0 rounded-4 mt-4" style="background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="bi bi-info-circle-fill text-success" style="font-size: 2.5rem;"></i>
                        </div>
                        <div class="col">
                            <h6 class="fw-bold mb-2 text-success">¿Sabías que...?</h6>
                            <p class="mb-0 text-muted small">
                                Los productos en tus favoritos se guardan para que puedas acceder a ellos fácilmente. 
                                <strong>Todos nuestros productos son 100% naturales</strong> y pensados en tu bienestar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER MENSAJE --}}
            <div class="text-center mt-4 py-3">
                <p class="text-muted small mb-0">
                    <i class="bi bi-heart-fill text-success me-1"></i>
                    <strong>Gracias por confiar en D'Campo</strong>
                    <i class="bi bi-heart-fill text-success ms-1"></i>
                </p>
            </div>

        </div>

    </div>
</div>

{{-- ESTILOS ADICIONALES --}}
<style>
.hover-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.hover-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>

{{-- SCRIPT: toggle favorito --}}
<script>
document.querySelectorAll('.remove-fav').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.dataset.id;
        let card = this.closest('.card');
        
        // Agregar efecto de carga
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Quitando...';

        fetch(`/favorito/${id}`, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.favorito === false) {
                // Animación de salida
                card.style.transition = 'all 0.3s ease';
                card.style.opacity = '0';
                card.style.transform = 'translateX(100px)';
                
                setTimeout(() => {
                    location.reload();
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-heart-fill me-2"></i>Quitar de favoritos';
        });
    });
});
</script>
@endsection