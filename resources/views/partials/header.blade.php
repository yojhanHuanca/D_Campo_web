<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand fw-bold text-success fs-4 d-flex align-items-center" href="{{ url('/') }}">
            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center text-white" 
                 style="width: 40px; height: 40px;">
                D
            </div>
            <span class="ms-2">D'CAMPO</span>
        </a>

        {{-- BOTÓN MENÚ MÓVIL --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- MENÚ CENTRO --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                {{-- INICIO --}}
                <li class="nav-item mx-2">
                    <a href="{{ url('/') }}" 
                       class="nav-link {{ request()->is('/') ? 'text-success fw-bold' : '' }}">
                        Inicio
                    </a>
                </li>

                {{-- TIENDA --}}
                <li class="nav-item mx-2">
                    <a href="{{ route('store.index') }}" 
                       class="nav-link {{ request()->is('tienda*') ? 'text-success fw-bold' : '' }}">
                        Tienda
                    </a>
                </li>

                {{-- NOSOTROS --}}
                <li class="nav-item mx-2">
                    <a href="{{ route('nosotros') }}"
                       class="nav-link {{ request()->is('nosotros') ? 'text-success fw-bold' : '' }}">
                        Nosotros
                    </a>
                </li>

                {{-- CONTACTO --}}
                <li class="nav-item mx-2">
                    <a href="{{ route('contacto') }}"
                       class="nav-link {{ request()->is('contacto') ? 'text-success fw-bold' : '' }}">
                        Contacto
                    </a>
                </li>

            </ul>

            {{-- ICONOS DERECHA --}}
            <div class="d-flex align-items-center">

                {{-- CARRITO SOLO PARA CLIENTES --}}
                @if(!auth()->check() || (auth()->check() && !auth()->user()->is_admin))
                    <a href="{{ route('cart.index') }}" class="text-dark fs-5 position-relative me-4">
                        <i class="bi bi-cart" style="font-size:20px;"></i>

                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                  style="font-size:10px;">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endif

                {{-- USUARIO LOGUEADO --}}
                @if(auth()->check())
                    <div class="dropdown">

                        <a class="text-dark fs-4 dropdown-toggle d-flex align-items-center" 
                           href="#" role="button" data-bs-toggle="dropdown">

                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                                 style="width: 36px; height: 36px; font-size: 0.9rem;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li class="px-3 py-2">
                                <strong>{{ auth()->user()->name }}</strong><br>
                                <small class="text-muted">{{ auth()->user()->email }}</small>

                                @if(auth()->user()->is_admin)
                                    <div class="text-success small mt-1">
                                        <i class="bi bi-shield-lock"></i> Administrador
                                    </div>
                                @endif
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- PANEL ADMIN --}}
                            @if(auth()->user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Panel de Administración
                                    </a>
                                </li>
                            @endif

                            {{-- PERFIL --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                    <i class="bi bi-person-circle me-2"></i> Mi Perfil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            {{-- LOGOUT --}}
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                {{-- USUARIO NO LOGUEADO --}}
                @else
                    <a href="{{ route('auth.login.form') }}" class="text-dark fs-5">
                        <i class="bi bi-person"></i>
                    </a>
                @endif

            </div>
        </div>
    </div>
</nav>
