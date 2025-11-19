<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PedidoItem;
use App\Models\DireccionEnvio;
use App\Models\Pago;
use App\Models\User;


class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pago_id',
        'direccion_envio_id',
        'codigo_seguimiento',
        'subtotal',
        'igv',
        'envio',
        'total',
        'estado'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }

    // Relación con pago
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    // Relación con dirección de envío
    public function direccion()
    {
        return $this->belongsTo(DireccionEnvio::class, 'direccion_envio_id');
    }

    // Relación con items del pedido
    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
