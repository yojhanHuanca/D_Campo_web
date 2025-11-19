<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'user_id',
        'direccion_envio_id',
        'metodo_pago',
        'monto',
        'estado',
        'codigo_operacion',
        'numero_tarjeta',
        'nombre_titular',
        'vencimiento',
        'cvv',
        'comprobante',
    ];
}
