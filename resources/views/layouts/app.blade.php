<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <!-- 🌿 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success fs-4" href="{{ url('/') }}">
                D'CAMPO
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <!-- Menú centrado -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <li class="nav-item mx-2"><a class="nav-link text-success fw-semibold" href="#">Inicio</a></li>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link text-dark fw-medium" href="{{ route('store.index') }}">Tienda</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link text-dark fw-medium" href="#">Nosotros</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link text-dark fw-medium" href="#">Contacto</a>
                    </li>
                </ul>

                <!-- Icono del carrito -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart.index') }}" class="text-dark fs-5 position-relative">
                        <i class="bi bi-cart3"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>