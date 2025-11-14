<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Producto;

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

        $producto = Producto::find($request->product_id);

        // Buscar si ya está en el carrito
        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $producto->id)
            ->first();

        if ($item) {
            // Si ya está, solo aumentamos la cantidad
            $item->increment('cantidad', $request->cantidad);
        } else {
        
            // Si no está, lo creamos
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio,
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    // Actualizar cantidad (sumar o restar)
    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = CartItem::where('id', $request->item_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $item->cantidad = $request->cantidad;
        $item->save();

        return back();
    }

    // Eliminar del carrito
    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
        ]);

        CartItem::where('id', $request->item_id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
