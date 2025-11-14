<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false; 
    protected $primaryKey = null;

     
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'product_id',
        'cantidad',
        'precio_unitario'

    ];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('user_id', $this->user_id)
                    ->where('product_id', $this->product_id);
    }

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }
}
