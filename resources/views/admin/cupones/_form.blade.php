<div class="row">

    {{-- Código --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Código del cupón</label>
        <input type="text" name="codigo" class="form-control"
            value="{{ old('codigo', $cupon->codigo ?? '') }}" required>
    </div>

    {{-- Tipo --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Tipo de descuento</label>
        <select name="tipo" class="form-select" required>
            <option value="porcentaje"
                {{ old('tipo', $cupon->tipo ?? '') == 'porcentaje' ? 'selected' : '' }}>
                Porcentaje (%)
            </option>

            <option value="monto"
                {{ old('tipo', $cupon->tipo ?? '') == 'monto' ? 'selected' : '' }}>
                Monto (S/)
            </option>
        </select>
    </div>

    {{-- Valor --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Valor del descuento</label>
        <input type="number" step="0.01" name="valor" class="form-control"
            value="{{ old('valor', $cupon->valor ?? '') }}" required>
    </div>

    {{-- Mínimo de compra --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Compra mínima (S/)</label>
        <input type="number" step="0.01" name="compra_minima" class="form-control"
            value="{{ old('compra_minima', $cupon->compra_minima ?? 0) }}">
    </div>

    {{-- Descripción --}}
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Descripción</label>
        <input type="text" name="descripcion" class="form-control"
            value="{{ old('descripcion', $cupon->descripcion ?? '') }}">
    </div>

    {{-- Fecha inicio --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Fecha de inicio</label>
        <input type="date" name="fecha_inicio" class="form-control"
            value="{{ old('fecha_inicio', $cupon->fecha_inicio ?? '') }}">
    </div>

    {{-- Fecha fin --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Fecha de expiración</label>
        <input type="date" name="fecha_fin" class="form-control"
            value="{{ old('fecha_fin', $cupon->fecha_fin ?? '') }}">
    </div>

    {{-- Límite de uso --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Límite de uso</label>
        <input type="number" name="limite_uso" class="form-control"
            value="{{ old('limite_uso', $cupon->limite_uso ?? '') }}">
    </div>

    {{-- Estado --}}
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Estado</label>
        <select name="activo" class="form-select">
            <option value="1" {{ old('activo', $cupon->activo ?? 1) == 1 ? 'selected' : '' }}>
                Activo
            </option>
            <option value="0" {{ old('activo', $cupon->activo ?? 1) == 0 ? 'selected' : '' }}>
                Inactivo
            </option>
        </select>
    </div>

</div>
