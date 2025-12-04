@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="fw-bold mb-1"><i class="bi bi-headset me-2 text-success"></i>Soporte y Asesoría</h5>
                    <p class="text-muted mb-0 small">Gestiona las consultas enviadas por los usuarios.</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Categoría</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($threads as $thread)
                            @php
                                $consulta = $thread['ultimo'];
                                $pendientes = $thread['pendientes'];
                            @endphp
                            <tr>
                                <td class="fw-semibold">#{{ $consulta->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $consulta->user->name ?? 'Invitado' }}</div>
                                    <small class="text-muted">{{ $consulta->email_contacto }}</small>
                                    @if($pendientes > 0)
                                        <div><span class="badge bg-danger rounded-pill">{{ $pendientes }} nuevo(s)</span></div>
                                    @endif
                                </td>
                                <td>{{ $consulta->categoria }}</td>
                                <td>{{ $consulta->asunto }}</td>
                                <td>
                                    @if($consulta->estado === 'respondido')
                                        <span class="badge bg-success-subtle text-success rounded-pill">Respondido</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning rounded-pill">Pendiente</span>
                                    @endif
                                </td>
                                <td>{{ $consulta->created_at?->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.soporte.show', $consulta->id) }}" class="btn btn-sm btn-outline-success rounded-pill">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                    <form action="{{ route('admin.soporte.ia', $consulta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill">
                                            <i class="bi bi-robot"></i> Generar respuesta IA
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay consultas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
