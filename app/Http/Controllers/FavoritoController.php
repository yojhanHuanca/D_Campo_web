<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\Producto;

class FavoritoController extends Controller
{
    // Mostrar lista de favoritos
    public function index()
    {
        $favoritos = Favorito::with('producto')
            ->where('user_id', Auth::id())
            ->get();

        return view('perfil.favoritos', compact('favoritos'));
    }

    // Añadir o quitar favorito (toggle)
    public function toggle($producto_id)
    {
        $user_id = Auth::id();

        $exists = Favorito::where('user_id', $user_id)
            ->where('producto_id', $producto_id)
            ->first();

        if ($exists) {
            $exists->delete();
            return response()->json(['favorito' => false]);
        }

        Favorito::create([
            'user_id' => $user_id,
            'producto_id' => $producto_id
        ]);

        return response()->json(['favorito' => true]);
    }
}
