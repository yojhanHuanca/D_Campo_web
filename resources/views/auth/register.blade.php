<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - D'Campo</title>
</head>
<body>
    <h2>Registro de usuario</h2>

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

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('auth.register') }}">
        @csrf
        <label>Nombre:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Correo electrónico:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirmar contraseña:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit">Registrar</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('auth.login.form') }}">Inicia sesión aquí</a></p>
</body>
</html>
