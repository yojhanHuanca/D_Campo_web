@php
    $hasResenas = isset($resenas) && $resenas->count() > 0;
@endphp

<section class="py-5 bg-light">
    <div class="container">

        <!-- ENCABEZADO -->
        <div class="text-center mb-5">
            <span class="badge bg-success px-3 py-2 mb-3">Opiniones reales</span>
            <h2 class="fw-bold">Lo que dicen nuestros clientes</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Miles de personas ya confían en D'Campo para su cuidado personal y bienestar.
            </p>
        </div>

        @if($hasResenas)
            <div class="row g-4">
                @foreach($resenas as $resena)
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 bg-white rounded-4 shadow-sm border h-100">
                            <div class="text-warning fs-5 mb-2">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="bi bi-star{{ $i < round($resena->puntuacion) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>

                            <p class="fst-italic text-muted mb-3">
                                “{{ Str::limit($resena->comentario, 140) }}”
                            </p>

                            <hr>

                            <p class="fw-bold mb-0">{{ $resena->usuario->name ?? 'Cliente' }}</p>
                            <small class="text-muted">
                                {{ $resena->producto->nombre ?? 'Producto' }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row g-4">
                @foreach([1,2,3,4] as $i)
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 bg-white rounded-4 shadow-sm border h-100">
                            <div class="text-warning fs-5 mb-2">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                            </div>
                            <p class="fst-italic text-muted mb-3">
                                “Aún no hay reseñas, pronto verás opiniones de nuestros clientes.”
                            </p>
                            <hr>
                            <p class="fw-bold mb-0">Cliente</p>
                            <small class="text-muted">D'Campo</small>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- SELLO DE CONFIANZA -->
        <div class="text-center mt-5">
            <div class="d-inline-flex align-items-center gap-4 p-4 bg-white rounded-4 shadow-sm border">

                <div class="text-center">
                    <div class="fs-3">⭐</div>
                    <p class="fw-bold mb-0 text-success">
                        {{ $hasResenas ? number_format($resenas->avg('puntuacion'), 1) : '4.9' }} / 5.0
                    </p>
                    <small class="text-muted">Calificación promedio</small>
                </div>

                <div class="vr" style="height: 40px;"></div>

                <div class="text-center">
                    <div class="fs-3">👥</div>
                    <p class="fw-bold mb-0 text-success">
                        {{ $hasResenas ? $resenas->count() : '+15,000' }}
                    </p>
                    <small class="text-muted">{{ $hasResenas ? 'Opiniones recientes' : 'Clientes satisfechos' }}</small>
                </div>

            </div>
        </div>

    </div>
</section>
