<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - D'Campo</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        .sidebar a:hover {
            background: #e8f5e9;
            color: #2b5f2a;
        }
        .sidebar-title {
            font-size: 22px;
            font-weight: bold;
            padding: 20px;
        }
    </style>

</head>

<body>

    {{-- NAVBAR SUPERIOR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4" style="height: 65px;">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold">D'Campo — Panel de Control</span>

            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="d-flex">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-title">Menú</div>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.productos.index') }}">Productos</a>
            <a href="#">Pedidos</a>
            <a href="#">Reseñas</a>
            <a href="#">Cupones</a>
        </aside>

        {{-- CONTENIDO PRINCIPAL --}}
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>

    </div>

    {{-- Scripts Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
