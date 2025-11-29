<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaAdminController extends Controller
{
    // LISTAR RESEÑAS
    public function index(Request $request)
    {
        $busqueda = $request->q;
        $estado = $request->estado;  // <-- nuevo
    
        $resenas = Resena::with(['usuario', 'producto'])
    
            // FILTRO POR ESTADO
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado', $estado);
            })
    
            // FILTRO DE BÚSQUEDA
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where('comentario', 'like', "%$busqueda%")
                    ->orWhereHas('usuario', fn ($q) => $q->where('name', 'like', "%$busqueda%"))
                    ->orWhereHas('producto', fn ($q) => $q->where('nombre', 'like', "%$busqueda%"));
            })
    
            ->orderBy('created_at', 'desc')
            ->get();
    
        // ESTADÍSTICAS (SIEMPRE SOBRE TODAS LAS RESEÑAS)
        $total = Resena::count();
        $reportadas = Resena::where('estado', 'reportada')->count();
        $aprobadas = Resena::where('estado', 'aprobada')->count();
        $pendientes = Resena::where('estado', 'pendiente')->count();
        $promedio = Resena::avg('puntuacion') ?? 0;
    
        return view('admin.resenas.index', compact(
            'resenas', 'total', 'reportadas', 'aprobadas',
            'pendientes', 'promedio', 'busqueda', 'estado'
        ));
    }

    // DETALLES (MODAL FLOTANTE)
    public function show($id)
    {
        $resena = Resena::with(['usuario', 'producto'])->findOrFail($id);
        return view('admin.resenas.show', compact('resena'));
    }

    // APROBAR RESEÑA
    public function aprobar($id)
    {
        $resena = Resena::findOrFail($id);
        $resena->estado = 'aprobada';
        $resena->save();

        return redirect()
            ->route('admin.resenas.index')
            ->with('success', 'La reseña fue aprobada correctamente.');
    }

    // ELIMINAR
    public function eliminar($id)
    {
        Resena::findOrFail($id)->delete();

        return redirect()
            ->route('admin.resenas.index')
            ->with('success', 'La reseña fue eliminada correctamente.');
    }
}
