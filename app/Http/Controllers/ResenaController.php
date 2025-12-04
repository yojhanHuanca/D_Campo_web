<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;

class ResenaController extends Controller
{
    // GUARDAR RESEÑA
    public function store(Request $request, $productoId)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|max:1000',
        ]);

        $user = $request->user();

        // Verificar si el usuario ya ha comentado este producto
        $producto = \App\Models\Producto::findOrFail($productoId);
        if ($producto->usuarioYaComento($user->id)) {
            return back()->withErrors(['Ya has dejado una reseña para este producto.']);
        }

        // Crear la reseña
        Resena::create([
            'user_id'      => $user->id,
            'producto_id'  => $productoId,
            'puntuacion'   => $request->puntuacion, // ← AQUÍ SE ARREGLA
            'comentario'   => $request->comentario,
            'estado'       => 'pendiente',
        ]);

        return back()->with('success', 'Reseña enviada correctamente y está pendiente de aprobación.');
    }

    // REPORTAR RESEÑA
    public function reportar(Request $request, $id)
    {
        $request->validate([
            'motivo' => 'required|string|max:500',
        ]);
    
        $resena = Resena::findOrFail($id);
    
        $resena->update([
            'estado' => 'reportada',
            'motivo_reporte' => $request->motivo,
        ]);
    
        return back()->with('success', 'Reporte enviado correctamente.');
    }
    

    
}
