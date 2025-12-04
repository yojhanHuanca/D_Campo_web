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
        $orden = $request->input('orden'); // precio_asc | precio_desc
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

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

        if ($minPrice !== null && is_numeric($minPrice)) {
            $query->where('precio', '>=', (float) $minPrice);
        }

        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $query->where('precio', '<=', (float) $maxPrice);
        }

        if ($orden === 'precio_asc') {
            $query->orderBy('precio', 'asc');
        } elseif ($orden === 'precio_desc') {
            $query->orderBy('precio', 'desc');
        } else {
            $query->latest(); // destacados por defecto
        }

        $productos = $query->get();

        return view('tienda.index', compact(
            'productos',
            'busqueda',
            'categorias',
            'categoriaId',
            'orden',
            'minPrice',
            'maxPrice'
        ));
    }

    public function show($id)
    {
        // Busca el producto, si no existe lanza 404
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('tienda.show', compact('producto'));
    }
}
