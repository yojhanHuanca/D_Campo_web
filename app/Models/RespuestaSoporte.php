<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConsultaSoporte;
use App\Models\User;

class RespuestaSoporte extends Model
{
    protected $table = 'respuestas_soporte';

    protected $fillable = [
        'consulta_soporte_id',
        'user_id',
        'origen',
        'contenido',
    ];

    public function consulta()
    {
        return $this->belongsTo(ConsultaSoporte::class, 'consulta_soporte_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
