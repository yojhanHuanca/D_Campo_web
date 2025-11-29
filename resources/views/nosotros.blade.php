@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-5 bg-light text-center">
    <div class="container">
        <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-white shadow-sm rounded-pill mb-3">
            <i class="bi bi-heart-fill text-success"></i>
            <span class="text-success">Conoce nuestra historia</span>
        </div>

        <h1 class="display-4 fw-bold">Somos D'Campo</h1>

        <p class="text-muted fs-5 mx-auto" style="max-width: 700px;">
            Una marca peruana comprometida con tu bienestar y el cuidado del planeta, 
            aprovechando lo mejor de la palta orgánica.
        </p>
    </div>
</section>

<!-- STORY -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">

            <!-- IMAGEN -->
            <div class="col-md-6">
                <div class="rounded-4 overflow-hidden shadow-lg border border-white">
                    <img src="{{ asset('imagenes/avocadoheart.jpeg') }}" 
                         class="img-fluid w-100" 
                         style="height: 450px; object-fit: cover;" 
                         alt="Palta corazón">
                </div>
            </div>

            <!-- TEXTO -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Nuestra Misión</h2>

                <p class="text-muted fs-5">
                    En D'Campo creemos que la belleza y el bienestar vienen de la naturaleza.
                    Cada producto es elaborado con palta 100% orgánica cultivada por agricultores peruanos.
                </p>

                <p class="text-muted fs-5">
                    Ofrecemos productos de la más alta calidad, libres de químicos dañinos, crueldad animal 
                    y con impacto ambiental mínimo.
                </p>

                <p class="text-muted fs-5">
                    Queremos que sientas la diferencia de lo natural mientras apoyamos a las comunidades locales 
                    y cuidamos nuestro planeta.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- VALORES -->
<section class="py-5" style="background: #f3f7f3">
    <div class="container text-center">

        <h2 class="fw-bold mb-3">Nuestros Valores</h2>
        <p class="text-muted mx-auto mb-5" style="max-width: 600px;">
            Los principios que guían cada decisión que tomamos
        </p>

        <div class="row g-4">

            <div class="col-12 col-md-6 col-lg-3">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="icon-square bg-success bg-opacity-10 rounded-3 d-flex justify-content-center align-items-center mb-3" style="width: 70px; height:70px; margin:auto;">
                        <i class="bi bi-tree fs-2 text-success"></i>
                    </div>
                    <h5>Sostenibilidad</h5>
                    <p class="text-muted">Cuidamos el medio ambiente en cada etapa de producción</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="icon-square bg-success bg-opacity-10 rounded-3 d-flex justify-content-center align-items-center mb-3" style="width: 70px; height:70px; margin:auto;">
                        <i class="bi bi-heart text-success fs-1"></i>
                    </div>
                    <h5>Calidad</h5>
                    <p class="text-muted">Solo ingredientes premium para resultados excepcionales</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="icon-square bg-success bg-opacity-10 rounded-3 d-flex justify-content-center align-items-center mb-3" style="width: 70px; height:70px; margin:auto;">
                        <i class="bi bi-people text-success fs-1"></i>
                    </div>
                    <h5>Comunidad</h5>
                    <p class="text-muted">Apoyamos a agricultores y comunidades locales</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <div class="icon-square bg-success bg-opacity-10 rounded-3 d-flex justify-content-center align-items-center mb-3" style="width: 70px; height:70px; margin:auto;">
                        <i class="bi bi-award text-success fs-1"></i>
                    </div>
                    <h5>Excelencia</h5>
                    <p class="text-muted">Comprometidos con la innovación y mejora continua</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ESTADÍSTICAS -->
<section class="py-5 text-white" style="background: #2e7d32;">
    <div class="container text-center">

        <div class="row g-4">

            <div class="col-md-3">
                <h2 class="fw-bold display-5">15k+</h2>
                <p class="text-white-50">Clientes satisfechos</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold display-5">100%</h2>
                <p class="text-white-50">Orgánico certificado</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold display-5">50+</h2>
                <p class="text-white-50">Agricultores aliados</p>
            </div>

            <div class="col-md-3">
                <h2 class="fw-bold display-5">5+</h2>
                <p class="text-white-50">Años de experiencia</p>
            </div>

        </div>

    </div>
</section>

<!-- TEAM -->
<section class="py-5 bg-white">
    <div class="container text-center">

        <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-success bg-opacity-10 rounded-pill mb-3">
            <i class="bi bi-stars text-success"></i>
            <span class="text-success">Nuestro compromiso</span>
        </div>

        <h2 class="fw-bold mb-3">Un equipo apasionado</h2>

        <p class="text-muted fs-5 mx-auto mb-4" style="max-width: 700px;">
            Detrás de D'Campo hay un equipo comprometido con la naturaleza, 
            la innovación y tu bienestar.
        </p>

        <!-- GRID IMÁGENES -->
        <div class="row g-4 justify-content-center">

            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-lg">
                    <img src="{{ asset('imagenes/team_production.jpeg') }}" 
                         class="img-fluid w-100"
                         style="height: 300px; object-fit: cover;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-lg">
                    <img src="{{ asset('imagenes/team_artisan.jpeg') }}" 
                         class="img-fluid w-100"
                         style="height: 300px; object-fit: cover;">
                </div>
            </div>

            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-lg">
                    <img src="{{ asset('imagenes/team_products.jpeg') }}" 
                         class="img-fluid w-100"
                         style="height: 300px; object-fit: cover;">
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
