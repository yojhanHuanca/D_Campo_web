@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <a href="{{ route('admin.soporte.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="bi bi-arrow-left"></i> Volver a soporte
                </a>
                <div>
                    <span class="badge bg-success-subtle text-success rounded-pill">#{{ $consulta->id }}</span>
                    @if($consulta->estado === 'respondido')
                        <span class="badge bg-success-subtle text-success rounded-pill">Respondido</span>
                    @else
                        <span class="badge bg-warning-subtle text-warning rounded-pill">Pendiente</span>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-3" style="height: 560px;">
                <div class="card-body d-flex flex-column h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $consulta->asunto }}</h5>
                            <small class="text-muted">Categoría: {{ $consulta->categoria }} · {{ $consulta->created_at?->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>

                    <div id="chatBox" class="border rounded-4 p-3 bg-light flex-grow-1" style="overflow-y: auto;">
                        {{-- Mensaje inicial --}}
                        <div class="d-flex gap-2 align-items-start mb-3">
                            <div class="avatar-circle text-success">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">Usuario</div>
                                <small class="text-muted d-block">{{ $consulta->created_at?->format('d/m/Y H:i') }}</small>
                                <div class="bubble user mt-1">{{ $consulta->mensaje }}</div>
                            </div>
                        </div>

                        {{-- Respuestas --}}
                        @forelse($consulta->respuestas as $respuesta)
                            @if($respuesta->origen === 'usuario')
                                <div class="d-flex gap-2 align-items-start mb-3 flex-row-reverse text-end">
                                    <div class="avatar-circle text-success">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">Usuario</div>
                                        <small class="text-muted d-block">{{ $respuesta->created_at?->format('d/m/Y H:i') }}</small>
                                        <div class="bubble user mt-1">{{ $respuesta->contenido }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex gap-2 align-items-start mb-3">
                                    <div class="avatar-circle text-primary">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">Soporte <small class="text-muted">({{ $respuesta->origen }})</small></div>
                                        <small class="text-muted d-block">{{ $respuesta->created_at?->format('d/m/Y H:i') }}</small>
                                        <div class="bubble support mt-1">{{ $respuesta->contenido }}</div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-muted small mb-0">Aún no hay respuestas.</p>
                        @endforelse
                    </div>

                    {{-- Input respuesta --}}
                    <div class="mt-3">
                        <form action="{{ route('admin.soporte.responder', $consulta->id) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="text" name="respuesta" class="form-control rounded-3" placeholder="Escribe tu respuesta..." required>
                            <button type="submit" class="btn btn-success rounded-pill">
                                <i class="bi bi-send"></i>
                            </button>
                            <button formaction="{{ route('admin.soporte.ia', $consulta->id) }}" class="btn btn-outline-success rounded-pill" type="submit">
                                <i class="bi bi-robot"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-2"><i class="bi bi-person-circle me-2 text-success"></i>Usuario</h6>
                    <p class="mb-0 fw-semibold">{{ $consulta->user->name ?? 'Invitado' }}</p>
                    <small class="text-muted d-block mb-2">{{ $consulta->email_contacto }}</small>
                    <small class="text-muted">Fecha: {{ $consulta->created_at?->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-circle {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: rgba(25,135,84,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}
.bubble {
    border-radius: 14px;
    padding: 10px 12px;
    display: inline-block;
    max-width: 100%;
}
.bubble.user {
    background: #e5f9ec;
}
.bubble.support {
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.07);
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const chatBox = document.getElementById('chatBox');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>
@endpush