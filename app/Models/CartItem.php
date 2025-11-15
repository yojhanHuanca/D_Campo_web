<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'producto_id',
        'cantidad',
        'precio_unitario'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

