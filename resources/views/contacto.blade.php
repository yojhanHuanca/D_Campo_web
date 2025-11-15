@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-5 bg-light text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Contáctanos</h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">
            Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos lo antes posible.
        </p>
    </div>
</section>

<!-- CONTENIDO -->
<div class="container py-5">

    <div class="row g-5">

        <!-- INFORMACIÓN -->
        <div class="col-md-5">

            <h2 class="fw-bold mb-4">Información de contacto</h2>

            <div class="d-flex gap-3 align-items-start p-3 border rounded-3 shadow-sm mb-3">
                <i class="bi bi-telephone fs-3 text-success"></i>
                <div>
                    <strong>Teléfono</strong>
                    <p class="text-muted mb-0">+51 999 888 777</p>
                    <small class="text-muted">Lun - Vie: 9am - 6pm</small>
                </div>
            </div>

            <div class="d-flex gap-3 align-items-start p-3 border rounded-3 shadow-sm mb-3">
                <i class="bi bi-envelope fs-3 text-success"></i>
                <div>
                    <strong>Email</strong>
                    <p class="text-muted mb-0">contacto@dcampo.pe</p>
                    <small class="text-muted">Respondemos en 24 horas</small>
                </div>
            </div>

            <div class="d-flex gap-3 align-items-start p-3 border rounded-3 shadow-sm mb-3">
                <i class="bi bi-geo-alt fs-3 text-success"></i>
                <div>
                    <strong>Ubicación</strong>
                    <p class="text-muted mb-0">Av. Javier Prado Este 4200</p>
                    <small class="text-muted">Lima, Perú</small>
                </div>
            </div>

            <h3 class="fw-bold mt-4">Síguenos</h3>

            <div class="d-flex gap-3 mt-3">

                <a href="#" class="btn btn-success btn-lg rounded-circle">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="#" class="btn btn-success btn-lg rounded-circle">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="#" class="btn btn-success btn-lg rounded-circle">
                    <i class="bi bi-twitter"></i>
                </a>

            </div>

        </div>

        <!-- FORMULARIO -->
        <div class="col-md-7">

            <div class="p-4 border rounded-4 shadow-lg bg-white">

                <h3 class="fw-bold mb-4">Envíanos un mensaje</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre completo</label>
                        <input type="text" name="name" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Correo electrónico</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mensaje</label>
                        <textarea name="message" rows="6" class="form-control" required></textarea>
                    </div>

                    <button class="btn btn-success w-100 btn-lg">
                        <i class="bi bi-send me-2"></i>
                        Enviar mensaje
                    </button>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection
