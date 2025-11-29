<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaSoporte extends Model
{
    protected $table = 'consulta_soportes';

    protected $fillable = [
        'user_id',
        'categoria',
        'asunto',
        'mensaje',
        'email_contacto',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
