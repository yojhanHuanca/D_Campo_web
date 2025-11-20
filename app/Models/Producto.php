<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resena; // ← ESTO FALTABA

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'categoria_id',
        'imagen',
        'descripcion_corta',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // RELACIÓN CON RESEÑAS
    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }

    public function promedio()
    {
        return $this->resenas()->avg('puntuacion') ?? 0;
    }

    public function cantidadEstrellas($n)
    {
        return $this->resenas()->where('puntuacion', $n)->count();
    }

    public function porcentajeEstrellas($n)
    {
        $total = $this->resenas()->count();
        if ($total == 0) return 0;

        return round($this->cantidadEstrellas($n) / $total * 100);
    }

    public function usuarioYaComento($userId)
    {
        return $this->resenas()->where('user_id', $userId)->exists();
    }
}
