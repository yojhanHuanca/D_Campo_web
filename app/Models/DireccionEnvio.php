<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DireccionEnvio extends Model
{
    use HasFactory;

    protected $table = 'direcciones_envio';

    protected $fillable = [
        'user_id',
        'nombre_completo',
        'direccion',
        'ciudad',
        'telefono',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
