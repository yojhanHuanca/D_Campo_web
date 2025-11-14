<section class="py-5" id="benefits-carousel">

    <div class="container text-center mb-5">
        <h2 class="fw-bold">Beneficios de nuestros productos</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Descubre cómo la naturaleza transforma tu rutina de belleza.
        </p>
    </div>

    <div id="carouselBenefits" class="carousel slide" data-bs-ride="carousel">
        
        <div class="carousel-inner">

            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <div class="benefit-img-container">
                    <img src="{{ asset('imagenes/hydration.jpeg') }}" class="benefit-img" alt="Hidratación profunda">
                </div>
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h3>Hidratación profunda</h3>
                    <p>Nuestra fórmula con aceite de palta penetra capas profundas de la piel.</p>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="carousel-item">
                <div class="benefit-img-container">
                    <img src="{{ asset('imagenes/avocado.jpeg') }}" class="benefit-img" alt="Ingredientes naturales">
                </div>
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h3>Ingredientes orgánicos</h3>
                    <p>Solo ingredientes naturales certificados, sin químicos dañinos.</p>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="carousel-item">
                <div class="benefit-img-container">
                    <img src="{{ asset('imagenes/skincare.jpeg') }}" class="benefit-img" alt="Resultados visibles">
                </div>
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h3>Resultados visibles</h3>
                    <p>Experimenta transformación visible desde las primeras aplicaciones.</p>
                </div>
            </div>

        </div>

        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBenefits" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselBenefits" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>

    {{-- Dots --}}
    <div class="d-flex justify-content-center mt-3 gap-2">
        <button type="button" data-bs-target="#carouselBenefits" data-bs-slide-to="0" class="active btn btn-sm btn-primary rounded-circle"></button>
        <button type="button" data-bs-target="#carouselBenefits" data-bs-slide-to="1" class="btn btn-sm btn-secondary rounded-circle"></button>
        <button type="button" data-bs-target="#carouselBenefits" data-bs-slide-to="2" class="btn btn-sm btn-secondary rounded-circle"></button>
    </div>

</section>

{{-- CUSTOM CSS PARA FIGMA STYLE --}}
<style>
    .benefit-img-container {
        height: 480px;          /* Ajusta a tu gusto (400–500 recomendado) */
        overflow: hidden;
        border-radius: 20px;    /* Igual que en Figma */
    }

    .benefit-img {
        width: 100%;
        height: 100%;
        object-fit: cover;      /* IMPORTANTÍSIMO para que no se deforme */
    }
</style>
