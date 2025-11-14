<?php

namespace App\Http\Controllers;
use App\Models\Producto;   

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('q');

        $query = Producto::query()->where('activo', 1);

        if ($busqueda) {
             $query->where('nombre', 'like', '%' . $busqueda . '%');
        }

        $productos = $query->with('categoria')->get();

        return view('tienda.index', compact('productos', 'busqueda'));
    }

    public function show($id)
    {
        // Busca el producto, si no existe lanza 404
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('tienda.show', compact('producto'));
    }
}
