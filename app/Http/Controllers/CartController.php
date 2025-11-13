<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login.form')
                ->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }
    
        $items = CartItem::where('user_id', Auth::id())->get();
    
        return view('cart.index', compact('items'));
    }

    // Agregar producto al carrito
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Debe iniciar sesión'], 401);
        }
        $request->validate([
            'product_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::find($request->product_id);

        // Verificar si ya existe en el carrito
        $item = CartItem::where('user_id', Auth::id())
                ->where('product_id', $producto->id)
                ->first();

                if ($item) {
                    $item->cantidad += $request->cantidad;
                    $item->save();
                } else {
                    CartItem::create([
                        'user_id' => Auth::id(),
                        'product_id' => $producto->id,
                        'cantidad' => $request->cantidad,
                        'precio_unitario' => $producto->precio
                    ]);
        }

        return back()->with('success', 'Producto agregado al carrito.');
    }

    // Actualizar cantidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $item = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $item->cantidad = $request->cantidad;
        $item->save();

        return back()->with('success', 'Cantidad actualizada.');
    }

    // Eliminar un producto del carrito
    public function remove($id)
    {
        $item = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar carrito
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Carrito vaciado.');
    }
}