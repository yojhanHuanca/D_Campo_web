<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Categoria;   
use App\Models\Cupon;
use App\Services\IAProductoService;

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

    public function chatProducto(Request $request, $id, IAProductoService $ia)
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
        ]);

        $producto = Producto::with('categoria')->findOrFail($id);

        $relacionados = Producto::with('categoria')
            ->where('categoria_id', $producto->categoria_id)
            ->where('id', '<>', $producto->id)
            ->take(4)
            ->get(['nombre', 'precio', 'categoria_id'])
            ->map(function ($p) {
                return [
                    'nombre' => $p->nombre,
                    'precio' => $p->precio,
                    'categoria' => $p->categoria?->nombre ?? '',
                ];
            })
            ->toArray();

        $contexto = [
            'pregunta' => $request->mensaje,
            'modo' => 'producto',
            'producto_actual' => [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'categoria' => $producto->categoria?->nombre ?? '',
                'descripcion' => $producto->descripcion ?? '',
                'beneficios' => $producto->beneficios ?? '',
                'ingredientes' => $producto->ingredientes ?? '',
                'tipo_piel' => $producto->tipo_piel ?? '',
            ],
            'productos_relacionados' => $relacionados,
        ];

        $respuesta = $ia->generarRespuesta($contexto);

        return response()->json([
            'success' => true,
            'respuesta' => $respuesta,
        ]);
    }

    public function chatCatalogo(Request $request, IAProductoService $ia)
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
        ]);

        $productos = Producto::with('categoria')
            ->where('activo', 1)
            ->latest()
            ->take(20)
            ->get();

        $cupones = Cupon::where('activo', 1)
            ->where(function ($q) {
                $q->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', now()->toDateString());
            })
            ->get(['codigo', 'valor', 'tipo', 'fecha_fin', 'compra_minima']);
        $categorias = Categoria::pluck('nombre')->toArray();

        $listaProductos = $productos->map(function ($p) {
            return [
                'nombre' => $p->nombre,
                'precio' => $p->precio,
                'categoria' => $p->categoria?->nombre ?? '',
                'stock' => $p->stock,
                'descripcion' => $p->descripcion ?? '',
                'beneficios' => $p->beneficios ?? '',
                'ingredientes' => $p->ingredientes ?? '',
                'tipo_piel' => $p->tipo_piel ?? '',
            ];
        })->toArray();

        $contexto = [
            'pregunta' => $request->mensaje,
            'modo' => 'catalogo',
            'productos' => $listaProductos,
            'categorias' => $categorias,
            'cupones' => $cupones->map(function ($c) {
                $valor = $c->tipo === 'porcentaje' ? "{$c->valor}%" : "S/ {$c->valor}";
                return [
                    'codigo' => $c->codigo,
                    'descuento' => $valor,
                    'fecha_fin' => $c->fecha_fin,
                    'compra_minima' => $c->compra_minima,
                ];
            })->toArray(),
        ];

        $respuesta = $ia->generarRespuesta($contexto);

        return response()->json([
            'success' => true,
            'respuesta' => $respuesta,
        ]);
    }
}
