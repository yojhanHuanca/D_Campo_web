@extends('admin.layouts.master')

@section('content')

<div class="container py-4">

    {{-- Título --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Nuevo Cupón</h4>

        <a href="{{ route('admin.cupones.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los campos:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.cupones.store') }}">
                @csrf

                {{-- Reutilizamos el form parcial --}}
                @include('admin.cupones._form', ['modo' => 'Crear'])

                <button type="submit" class="btn btn-success px-4 mt-3">
                    <i class="bi bi-check-circle"></i> Crear Cupón
                </button>
            </form>

        </div>
    </div>

</div>

@endsection
