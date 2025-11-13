<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>D'Campo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- Navbar del cliente --}}
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">D'Campo</a>

            <div>
            
                    <a href="{{ route('auth.login.form') }}" class="btn btn-primary btn-sm">Login</a>
               
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
