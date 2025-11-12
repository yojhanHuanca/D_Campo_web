<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control - D'Campo</title>
</head>
<body>
    <h2>👑 Estamos en el Panel de Control del Administrador 👑</h2>

    <p>Bienvenido {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>

    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
