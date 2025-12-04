<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use App\Models\Producto;
use App\Models\Cupon;

class CartController extends Controller
{
    // Ver carrito
    public function index()
    {
        $items = CartItem::with('producto')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('items'));
    }

    // Agregar producto
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login.form')
                ->with('error', 'Debes iniciar sesión para agregar productos al carrito.');
        }

        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        return DB::transaction(function () use ($request) {
            $producto = Producto::lockForUpdate()->find($request->product_id);

            if (!$producto) {
                return back()->with('error', 'Producto no disponible.');
            }

            $item = CartItem::where('user_id', Auth::id())
                ->where('producto_id', $producto->id)
                ->lockForUpdate()
                ->first();

            $cantidadSolicitada = (int) $request->cantidad;

            if ($producto->stock < $cantidadSolicitada) {
                return back()->with('error', 'Stock insuficiente. Solo quedan ' . $producto->stock . ' unidades.');
            }

            $producto->decrement('stock', $cantidadSolicitada);

            if ($item) {
                $item->increment('cantidad', $cantidadSolicitada);
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidadSolicitada,
                    'precio_unitario' => $producto->precio,
                ]);
            }

            return redirect()->back()->with('success', 'Producto agregado al carrito.');
        });
    }

    // Actualizar cantidad (sumar o restar)
    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        return DB::transaction(function () use ($request) {
            $item = CartItem::where('id', $request->item_id)
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->firstOrFail();

            $producto = Producto::lockForUpdate()->findOrFail($item->producto_id);

            $cantidadActual = $item->cantidad;
            $cantidadNueva = (int) $request->cantidad;

            if ($cantidadNueva > $cantidadActual) {
                $diferencia = $cantidadNueva - $cantidadActual;
                if ($producto->stock < $diferencia) {
                    return back()->with('error', 'Stock insuficiente. Solo quedan ' . $producto->stock . ' unidades.');
                }
                $producto->decrement('stock', $diferencia);
            } elseif ($cantidadNueva < $cantidadActual) {
                $devolver = $cantidadActual - $cantidadNueva;
                $producto->increment('stock', $devolver);
            }

            $item->cantidad = $cantidadNueva;
            $item->save();

            return back();
        });
    }

    // Eliminar del carrito
    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
        ]);

        return DB::transaction(function () use ($request) {
            $item = CartItem::where('id', $request->item_id)
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->first();

            if ($item) {
                $producto = Producto::lockForUpdate()->find($item->producto_id);
                if ($producto) {
                    $producto->increment('stock', $item->cantidad);
                }
                $item->delete();
            }

            return back()->with('success', 'Producto eliminado del carrito.');
        });
    }

    public function aplicarCupon(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string'
        ]);
    
        $user = Auth::user();
        $codigo = $request->codigo;
    
        $cupon = Cupon::where('codigo', $codigo)
            ->where('activo', 1)
            ->first();
    
        // Cupón inexistente
        if (!$cupon) {
            return response()->json([
                'success' => false,
                'message' => 'El cupón ingresado no existe.'
            ]);
        }
    
        // Validar fecha de inicio
        if ($cupon->fecha_inicio && now()->lt($cupon->fecha_inicio)) {
            return response()->json([
                'success' => false,
                'message' => 'Este cupón aún no está disponible.'
            ]);
        }
    
        // Validar fecha de fin
        if ($cupon->fecha_fin && now()->gt($cupon->fecha_fin)) {
            return response()->json([
                'success' => false,
                'message' => 'El cupón ha expirado.'
            ]);
        }
    
        // Validar límite de usos global
        if ($cupon->limite_uso && $cupon->usos_realizados >= $cupon->limite_uso) {
            return response()->json([
                'success' => false,
                'message' => 'Este cupón alcanzó su límite de usos.'
            ]);
        }
    
        // Validar si el usuario ya lo usó
        $yaUso = DB::table('cupon_usuario')
            ->where('user_id', $user->id)
            ->where('cupon_id', $cupon->id)
            ->exists();
    
        if ($yaUso) {
            return response()->json([
                'success' => false,
                'message' => 'Ya has usado este cupón anteriormente.'
            ]);
        }
    
        // Total enviado desde AJAX
        $totalCarrito = $request->total;
    
        // Validar compra mínima
        if ($cupon->compra_minima && $totalCarrito < $cupon->compra_minima) {
            return response()->json([
                'success' => false,
                'message' => 'Debes superar S/ ' . number_format($cupon->compra_minima, 2) . ' para usar este cupón.'
            ]);
        }
    
        // Calcular descuento
        if ($cupon->tipo === 'porcentaje') {
            $descuento = ($totalCarrito * $cupon->valor) / 100;
        } else { 
            $descuento = $cupon->valor;
        }
    
        // Guardar cupón en sesión
        session([
            'cupon_codigo'    => $cupon->codigo,
            'cupon_descuento' => $descuento,
            'cupon_id'        => $cupon->id,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Cupón aplicado correctamente.',
            'descuento' => $descuento,
            'cupon' => $cupon
        ]);
    }
}
