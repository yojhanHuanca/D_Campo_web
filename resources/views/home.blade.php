<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Campo </title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <!-- 🌿 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-success" href="#">
                <img src="{{ asset('img/home/logo.png') }}" alt="Logo Dcampo" width="40" class="me-2">
                D'CAMPO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mx-2"><a class="nav-link text-success fw-semibold" href="#">Inicio</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#">Tienda</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#">Nosotros</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#">Contacto</a></li>
                    <li class="nav-item mx-3">
                        <a href="#" class="text-success fs-5" ><i class="bi bi-cart3"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-success rounded-pill px-3"><i class="bi bi-person"></i> Ingresar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



 
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
