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

    <!-- 🌿 NAVBAR IDÉNTICO A TU IMAGEN -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success fs-4" href="#">
                D'CAMPO
            </a>

            <!-- Menú central -->
            <div class="navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Inicio</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="{{ route('store.index') }}">Tienda</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Nosotros</a></li>
                    <li class="nav-item mx-3"><a class="nav-link text-dark fw-medium" href="#">Contacto</a></li>
                </ul>
            </div>

            <!-- Iconos derecha -->
            <div class="d-flex align-items-center">
                <!-- Carrito -->
                <a href="{{ route('cart.index') }}" class="text-dark fs-5 position-relative me-4">
                    <i class="bi bi-cart3"></i>
                    @if(isset($cartCount) && $cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>

                <!-- Usuario -->
                <a href="{{ route('auth.login.form') }}" class="text-dark fs-5">
                    <i class="bi bi-person"></i>
                </a>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>