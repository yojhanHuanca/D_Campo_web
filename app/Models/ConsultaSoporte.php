<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RespuestaSoporte;
use App\Models\User;

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

    public function respuestas()
    {
        return $this->hasMany(RespuestaSoporte::class, 'consulta_soporte_id')->latest();
    }
}
