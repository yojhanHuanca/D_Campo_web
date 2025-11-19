<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;


class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cantidad de pedidos del usuario
        $totalPedidos = Pedido::where('user_id', $user->id)->count();

        // Favoritos (si luego agregas tabla favoritos)
        $totalFavoritos = 0;

        return view('perfil.index', compact(
            'user',
            'totalPedidos',
            'totalFavoritos'
        ));
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        $user->name = $request->name;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
    
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Datos actualizados correctamente.',
            'name' => $user->name,
            'telefono' => $user->telefono,
            'direccion' => $user->direccion
        ]);       
    }

}
