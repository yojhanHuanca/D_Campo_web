<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> perfil </title>
</head>
<body>
    @extends('layouts.perfil')

@section('content')
<div class="container py-3">
    
    <div class="row g-3">

        {{-- SIDEBAR --}}
        <div class="col-md-3">
            @include('perfil.sidebar')
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="col-md-9">

            {{-- Título --}}
            <h4 class="fw-bold mb-1">Mi Perfil 👤📋</h4>
            <p class="text-muted small mb-3">Gestiona tu información personal y preferencias</p>

            {{-- Cards de Resumen --}}
            <div class="row g-3 mb-3">

                {{-- Pedidos Totales --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4" style="background:#ecf4eb;">
                        <div class="card-body d-flex align-items-center p-3">
                            <div class="me-3">
                                <i class="bi bi-box-seam fs-2 text-success"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $totalPedidos }}</h4>
                                <small class="text-muted">Pedidos totales</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Productos Favoritos --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4" style="background:#fae4eb;">
                        <div class="card-body d-flex align-items-center p-3">
                            <div class="me-3">
                                <i class="bi bi-heart-fill fs-2 text-danger"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $totalFavoritos }}</h4>
                                <small class="text-muted">Productos favoritos</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Información Personal --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-person-lines-fill me-2 text-success"></i>
                        Información Personal
                    </h6>
                    <div id="buttonsContainer">
                        {{-- Botón Editar (se muestra por defecto) --}}
                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill" id="editButton">
                            <i class="bi bi-pencil-square me-1"></i> Editar
                        </button>

                        {{-- Botones Guardar/Cancelar (ocultos inicialmente) --}}
                        <div class="btn-group" id="actionButtons" style="display: none;">
                            <button type="button" class="btn btn-success btn-sm rounded-pill" id="saveButton">
                                <i class="bi bi-check-lg me-1"></i> Guardar
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" id="cancelButton">
                                <i class="bi bi-x-lg me-1"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">

                    <form id="profileForm">
                        {{-- Fila 1: Nombre y Email --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">
                                    <i class="bi bi-person-badge me-1"></i> Nombre completo
                                </label>
                                <input type="text" name="name" class="form-control form-control-sm rounded-3" disabled
                                       value="{{ Auth::user()->name }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">
                                    <i class="bi bi-envelope me-1"></i> Correo electrónico
                                </label>
                                <div class="form-control form-control-sm rounded-3 bg-light border">
                                    <strong class="text-dark">{{ Auth::user()->email }}</strong>
                                </div>
                                <small class="text-muted" style="font-size: 0.7rem;">
                                    <i class="bi bi-lock-fill"></i> El correo no puede ser modificado
                                </small>
                            </div>
                        </div>

                        {{-- Fila 2: Teléfono y Dirección --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">
                                    <i class="bi bi-telephone me-1"></i> Teléfono
                                </label>
                                <input type="text" name="telefono" class="form-control form-control-sm rounded-3" disabled 
                                       placeholder="Ej: +51 999 888 777"
                                       value="{{ Auth::user()->telefono ?? '' }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">
                                    <i class="bi bi-geo-alt me-1"></i> Dirección principal
                                </label>
                                <input type="text" name="direccion" class="form-control form-control-sm rounded-3" disabled 
                                       placeholder="Ej: Av. Principal 123, Lima"
                                       value="{{ Auth::user()->direccion ?? '' }}">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            {{-- Mensaje de Agradecimiento --}}
            <div class="card border-0 shadow-sm rounded-4 mt-3" style="background:#ecf4eb;">
                <div class="card-body p-3">
                    <p class="text-center text-muted mb-0 small">
                        🌿🌱 <strong>Gracias por confiar en la belleza natural de D'Campo</strong> 💚<br>
                        Tu bienestar es nuestra prioridad • Productos 100% naturales
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('editButton');
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');
    const actionButtons = document.getElementById('actionButtons');
    const inputs = document.querySelectorAll('#profileForm input[type="text"]');
    
    // Habilitar edición
    editButton.addEventListener('click', function() {
        // Habilitar solo los campos editables (excluir email)
        inputs.forEach(input => {
            if (input.name !== 'email') {
                input.disabled = false;
            }
        });
        
        // Cambiar botones
        editButton.style.display = 'none';
        actionButtons.style.display = 'flex';
    });
    
    // Cancelar edición
    cancelButton.addEventListener('click', function() {
        // Deshabilitar campos
        inputs.forEach(input => {
            input.disabled = true;
        });
        
        // Restaurar valores originales (aquí podrías agregar lógica para resetear)
        document.querySelector('input[name="name"]').value = "{{ Auth::user()->name }}";
        document.querySelector('input[name="telefono"]').value = "{{ Auth::user()->telefono ?? '' }}";
        document.querySelector('input[name="direccion"]').value = "{{ Auth::user()->direccion ?? '' }}";
        
        // Cambiar botones
        actionButtons.style.display = 'none';
        editButton.style.display = 'block';
    });
    
    // Guardar cambios
    saveButton.addEventListener('click', function() {
        // Aquí iría la lógica para guardar en la base de datos
        const formData = new FormData(document.getElementById('profileForm'));
        
        // Simular guardado (reemplazar con AJAX real)
        fetch("{{ route('perfil.actualizar') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Deshabilitar campos después de guardar
                inputs.forEach(input => {
                    input.disabled = true;
                });
                
                // Cambiar botones
                actionButtons.style.display = 'none';
                editButton.style.display = 'block';
                
                // Mostrar mensaje de éxito
                alert('Perfil actualizado correctamente');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el perfil');
        });
    });
});
</script>

<style>
.btn-group {
    gap: 8px;
}
</style>
@endsection
    
</body>
</html>