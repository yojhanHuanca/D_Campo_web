<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupones';

    protected $fillable = [
        'codigo',
        'tipo',
        'valor',
        'descripcion',
        'compra_minima',
        'fecha_inicio',
        'fecha_fin',
        'limite_uso',
        'usos_realizados',
        'activo',
    ];

    // PARA SABER SI ESTÁ EXPIRADO
    public function getExpiradoAttribute()
    {
        return $this->fecha_fin && $this->fecha_fin < now()->toDateString();
    }

    // PARA MOSTRAR "expira pronto" si faltan 5 días
    public function getExpiraProntoAttribute()
    {
        if (!$this->fecha_fin) return false;

        $diasRestantes = now()->diffInDays($this->fecha_fin, false);
        return $diasRestantes > 0 && $diasRestantes <= 5;
    }

    // PARA MOSTRAR FORMATO %
    public function getEtiquetaDescuentoAttribute()
    {
        return $this->tipo === 'porcentaje'
            ? "{$this->valor}% OFF"
            : "S/{$this->valor} OFF";
    }
}