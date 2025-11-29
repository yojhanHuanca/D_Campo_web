<section class="py-5 position-relative" id="brand-story">

    {{-- Fondos decorativos --}}
    <div class="position-absolute top-0 end-0 bg-success bg-opacity-25 rounded-circle blur-div"></div>
    <div class="position-absolute bottom-0 start-0 bg-warning bg-opacity-25 rounded-circle blur-div"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            {{-- Imagenes --}}
            <div class="col-md-6 position-relative">

                <div class="row g-3">
                    <div class="col-6">
                        <div class="rounded-4 overflow-hidden shadow border border-white">
                            <img src="{{ asset('imagenes/field.jpeg') }}" 
                                 class="w-100 brand-img" 
                                 alt="Nuestro campo natural">
                        </div>
                    </div>

                    <div class="col-6 mt-4">
                        <div class="rounded-4 overflow-hidden shadow border border-white">
                            <img src="{{ asset('imagenes/naturalproducts.jpeg') }}" 
                                 class="w-100 brand-img" 
                                 alt="Productos naturales D'Campo">
                        </div>
                    </div>
                </div>

                {{-- Tarjeta flotante --}}
                <div class="position-absolute bg-white shadow-lg rounded-4 p-4 floating-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-25 d-flex justify-content-center align-items-center" style="width: 55px; height: 55px;">
                            <i class="bi bi-award fs-3 text-success"></i>
                        </div>
                        <div>
                            <p class="h3 m-0 text-success">5+</p>
                            <small class="text-muted">Años de experiencia</small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Texto --}}
            <div class="col-md-6">

                <div class="badge bg-success bg-opacity-25 text-success px-4 py-2 mb-3 rounded-pill">
                    <i class="bi bi-heart-fill"></i> Nuestra Historia
                </div>

                <h2 class="fw-bold mb-4">Inspirados por la belleza natural</h2>

                <p class="text-muted lh-lg">
                    <strong class="text-dark">D'Campo</strong> nace de la pasión por la naturaleza y el deseo de compartir 
                    los increíbles beneficios de la palta peruana con el mundo.
                </p>

                <p class="text-muted lh-lg">
                    Trabajamos directamente con agricultores locales, asegurando que cada producto 
                    sea elaborado con ingredientes 100% orgánicos y de la más alta calidad.
                </p>

                <p class="text-muted lh-lg">
                    Nuestra misión es simple: ofrecer productos de belleza y bienestar que respeten 
                    tu piel, tu salud y nuestro planeta.
                </p>

                <div class="row text-center pt-3 g-3">
                    <div class="col-4">
                        <div class="p-4 bg-white shadow-sm rounded-4 border">
                            <i class="bi bi-tree fs-2 text-success"></i>
                            <p class="small mt-2 mb-0">100% Orgánico</p>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="p-4 bg-white shadow-sm rounded-4 border">
                            <i class="bi bi-heart fs-2 text-success"></i>
                            <p class="small mt-2 mb-0">Hecho con amor</p>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="p-4 bg-white shadow-sm rounded-4 border">
                            <i class="bi bi-award fs-2 text-success"></i>
                            <p class="small mt-2 mb-0">Certificado</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
    .brand-img {
        height: 230px;
        object-fit: cover;
    }

    .blur-div {
        width: 220px;
        height: 220px;
        filter: blur(50px);
        z-index: 0;
    }

    .floating-card {
        bottom: -20px;
        right: -20px;
        width: 220px;
    }
</style>
