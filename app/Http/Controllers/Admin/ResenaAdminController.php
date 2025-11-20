<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Resena;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class ResenaAdminController extends Controller
{
    // LISTAR RESEÑAS
    public function index(Request $request)
    {
        $busqueda = $request->q;

        $resenas = Resena::with(['usuario', 'producto'])
            ->when($busqueda, function ($query) use ($busqueda) {
                $query->where('comentario', 'like', "%$busqueda%")
                    ->orWhereHas('usuario', fn ($q) => $q->where('name', 'like', "%$busqueda%"))
                    ->orWhereHas('producto', fn ($q) => $q->where('nombre', 'like', "%$busqueda%"));
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Estadísticas
        $total = $resenas->count();
        $reportadas = $resenas->where('estado', 'reportada')->count();
        $aprobadas = $resenas->where('estado', 'aprobada')->count();
        $promedio = $resenas->avg('calificacion') ?? 0;

        return view('admin.resenas.index', compact(
            'resenas', 'total', 'reportadas', 'aprobadas', 'promedio', 'busqueda'
        ));
    }

    // DETALLES
    public function show($id)
    {
        $resena = Resena::with(['usuario', 'producto'])->findOrFail($id);

        return view('admin.resenas.show', compact('resena'));
    }

    // APROBAR
    public function aprobar($id)
    {
        $resena = Resena::findOrFail($id);
        $resena->estado = 'aprobada';
        $resena->save();

        return back()->with('success', 'Reseña aprobada correctamente.');
    }

    // ELIMINAR
    public function eliminar($id)
    {
        Resena::findOrFail($id)->delete();

        return back()->with('success', 'Reseña eliminada correctamente.');
    }
}
