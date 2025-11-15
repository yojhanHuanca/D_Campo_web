<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Categoria;   

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('q');

        $categoriaId = $request->input('categoria');

        $categorias = Categoria::all();

        $query = Producto::query()
            ->where('activo', 1)
            ->with('categoria');

        if ($busqueda) {
             $query->where('nombre', 'like', '%' . $busqueda . '%');
        }

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        $productos = $query->get();

        return view('tienda.index', compact(
            'productos',
            'busqueda',
            'categorias',
            'categoriaId'
        ));
    }

    public function show($id)
    {
        // Busca el producto, si no existe lanza 404
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('tienda.show', compact('producto'));
    }
}
