<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - D'Campo</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <div class="d-flex" style="min-height: 100vh;">

        {{-- SIDEBAR --}}
        <aside class="bg-white border-end" style="width: 280px; min-height: 100vh;">
            
            {{-- Logo/Título --}}
            <div class="p-4 border-bottom">
                <h4 class="mb-0 fw-bold text-success">
                    <i class="bi bi-shop me-2"></i>D'Campo
                </h4>
                <small class="text-muted">Panel de Control</small>
            </div>

            {{-- Información del Usuario --}}
            <div class="p-3 border-bottom bg-light">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                         style="width: 45px; height: 45px; font-size: 1.2rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold text-dark small">{{ Auth::user()->name }}</div>
                        <small class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email }}</small>
                    </div>
                </div>
            </div>

            {{-- Menú de Navegación --}}
            <nav class="p-3">
                <div class="mb-2">
                    <small class="text-muted text-uppercase fw-bold px-3" style="font-size: 0.75rem;">Navegación</small>
                </div>

                <a href="{{ route('admin.dashboard') }}" 
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-speedometer2 me-3"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.categorias.index') }}" 
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-tag me-3"></i>
                    <span>Categorías</span>
                </a>


                <a href="{{ route('admin.productos.index') }}" 
                    class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-cart-check me-3"></i>
                    <span>Productos</span>
                </a>

                <a href="{{ route('admin.pedidos.index') }}" 
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-cart-check me-3"></i>
                    <span>Pedidos</span>
                </a>

                <a href="{{ route('admin.resenas.index') }}" 
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-star me-3"></i>
                    <span>Reseñas</span>
                </a>

                <a href="{{ route('admin.cupones.index') }}" 
                   class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-ticket-perforated me-3"></i>
                    <span>Cupones</span>
                </a>

                <a href="{{ route('admin.soporte.index') }}" 
                    class="d-flex align-items-center text-decoration-none text-dark px-3 py-2 rounded mb-1 hover-item">
                    <i class="bi bi-headset me-3"></i>
                    <span>Soporte</span>
                </a>
            </nav>

            {{-- Botón Cerrar Sesión (al final del sidebar) --}}
            <div class="p-3 mt-auto border-top" style="position: absolute; bottom: 0; width: 280px;">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>

        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-grow-1">
            
            {{-- Barra Superior --}}
            <div class="bg-white border-bottom p-3 mb-4 shadow-sm">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-muted">
                            <i class="bi bi-house-door me-2"></i>
                            Administración D'Campo
                        </h5>
                        <div class="text-muted small">
                            <i class="bi bi-calendar3 me-2"></i>
                            {{ date('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contenido --}}
            <div class="container-fluid px-4">
                @yield('content')
            </div>

        </main>

    </div>

    {{-- Scripts Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .hover-item:hover {
            background-color: #e8f5e9;
            color: #2b5f2a !important;
        }
        
        .hover-item:hover i {
            color: #2b5f2a;
        }
    </style>

    @stack('scripts')
</body>
</html>
