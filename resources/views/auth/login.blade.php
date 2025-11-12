<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - D'Campo</title>
</head>
<body>
    <h2>Iniciar sesión</h2>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div>
            <strong>Errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mostrar mensaje de éxito --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Formulario de inicio de sesión --}}
    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <label>Correo electrónico:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tienes cuenta? <a href="{{ route('auth.register.form') }}">Regístrate aquí</a></p>
</body>
</html>
