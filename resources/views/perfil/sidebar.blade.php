<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar de perfil</title>
</head>
<body>
   {{-- SIDEBAR DEL PERFIL --}}
{{-- VOLVER AL INICIO (ARRIBA) --}}
    <li class="mb-3">
        <a href="{{ route('home') }}" 
           class="d-flex align-items-center text-success fw-semibold"
           style="text-decoration: none; font-size: 15px;">
            <i class="bi bi-arrow-left me-2 fs-5"></i>
            Volver al inicio
        </a>
    </li>
{{-- Card Superior Usuario --}}
<div class="card border-0 shadow-sm rounded-4 mb-3">
    
    <div class="card-body text-center p-3">
        
        {{-- Avatar --}}
        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2"
             style="width:70px; height:70px; background: linear-gradient(135deg, #c7e0c4, #e8d29d); color:white; font-size:24px; font-weight:600;">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        {{-- Nombre --}}
        <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">{{ Auth::user()->name }}</h6>
        <p class="text-muted small mb-2" style="font-size: 0.75rem;">{{ Auth::user()->email }}</p>

        {{-- Frase --}}
        <p class="text-success small mb-2" style="font-size: 0.7rem;">
            <i class="bi bi-flower1"></i> Amante del cuidado natural 🍃
        </p>

        {{-- Estadísticas --}}
        <div class="d-flex justify-content-around mb-2">
            <div>
                <span class="badge bg-danger rounded-pill">{{ $totalPedidos }}</span>
                <small class="text-muted" style="font-size: 0.7rem;">Pedidos</small>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-danger">{{ $totalFavoritos ?? 0 }}</h6>
                <small class="text-muted" style="font-size: 0.7rem;">Favoritos</small>
            </div>
        </div>

        {{-- Badge Pedidos --}}
        <button class="btn btn-primary btn-sm rounded-pill w-100" style="font-size: 0.75rem;">
            <i class="bi bi-box-seam me-1"></i>
            {{ $totalPedidos ?? 0 }} pedidos activos
        </button>

    </div>
</div>

{{-- Card Menú --}}
<div class="card border-0 shadow-sm rounded-4">
    
    {{-- Header con Gradiente --}}
    <div class="card-header border-0 rounded-top-4 text-white py-2"
         style="background: linear-gradient(90deg, #7aa77c, #d4c39a);">
        <span class="fw-bold" style="font-size: 0.9rem;">
            Perfil 📋📦
        </span>
    </div>

    {{-- Menú --}}
    <ul class="list-group list-group-flush">
        
        {{-- Perfil --}}
        <a href="{{ route('perfil.index') }}"
           class="list-group-item list-group-item-action d-flex align-items-center py-2">
            <i class="bi bi-person-bounding-box me-2"></i>
            <span class="fw-semibold" style="font-size: 0.85rem;">Perfil</span>
            <i class="bi bi-chevron-right ms-auto"></i>
        </a>

        {{-- Pedidos --}}
        <a href="{{ route('perfil.pedidos') }}"
           class="list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2">
            <div class="d-flex align-items-center">
                <i class="bi bi-box-seam me-2"></i>
                <span class="fw-semibold" style="font-size: 0.85rem;">Pedidos</span>
            </div>
            <span class="badge bg-danger rounded-pill">{{ $totalPedidos ?? 0 }}</span>
        </a>

        {{-- Favoritos --}}
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center py-2">
            <i class="bi bi-heart-fill text-success me-2"></i>
            <span class="fw-semibold" style="font-size: 0.85rem;">Favoritos</span>
            <span class="badge bg-success rounded-pill ms-auto">{{ $totalFavoritos ?? 0 }}</span>
        </a>

        {{-- Seguridad --}}
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center py-2">
            <i class="bi bi-lock-fill text-warning me-2"></i>
            <span class="fw-semibold" style="font-size: 0.85rem;">Seguridad</span>
            <i class="bi bi-shield-fill-check text-warning ms-auto"></i>
        </a>

        {{-- Asesoría --}}
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center py-2">
            <i class="bi bi-headset me-2"></i>
            <span class="fw-semibold" style="font-size: 0.85rem;">Asesoría</span>
            <i class="bi bi-chat-dots ms-auto"></i>
        </a>

    </ul>
    

    {{-- Footer Cerrar Sesión --}}
    <div class="card-footer bg-white text-center py-2">
        <a href="{{ route('auth.logout') }}" class="text-danger fw-bold text-decoration-none"
           style="font-size: 0.85rem;"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>