<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\DireccionEnvio;
use App\Models\Pago; 
use App\Models\Pedido;
use App\Models\PedidoItem;

class CheckoutController extends Controller
{
    //   VISTA DE ENVÍO
    public function envio()
    {
        $user = Auth::user();

        $items = CartItem::with('producto')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        $subtotal = $items->sum(fn($i) => $i->producto->precio * $i->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $total = $subtotal + $igv + $envio;

        $direccion = DireccionEnvio::where('user_id', $user->id)
            ->latest()
            ->first();

        return view('checkout.envio', compact(
            'items', 'subtotal', 'igv', 'envio', 'total', 'direccion'
        ));
    }

    // ============================
    //   GUARDAR ENVÍO
    // ============================
    public function guardarEnvio(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'direccion'       => 'required|string|max:255',
            'telefono'        => 'required|string|max:20',
            'email'           => 'nullable|email|max:255',
        ]);

        $user = Auth::user();

        $direccion = DireccionEnvio::create([
            'user_id'        => $user->id,
            'nombre_completo'=> $request->nombre_completo,
            'direccion'      => $request->direccion,
            'telefono'       => $request->telefono,
            'email'          => $request->email,
        ]);

        session(['direccion_envio_id' => $direccion->id]);

        return redirect()->route('checkout.pago')
            ->with('success', 'Información de envío guardada correctamente.');
    }

    // ============================
    //   VISTA DE PAGO
    // ============================
    public function pago()
    {
        $user = Auth::user();

        $items = CartItem::with('producto')
            ->where('user_id', $user->id)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        $subtotal = $items->sum(fn($i) => $i->producto->precio * $i->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $total = $subtotal + $igv + $envio;

        return view('checkout.pago', compact('items', 'subtotal', 'igv', 'envio', 'total'));
    }

    // ============================
    //   GUARDAR PAGO
    // ============================
    public function guardarPago(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,yape,plin,transferencia'
        ]);

        // Validaciones según método
        if ($request->metodo_pago === 'tarjeta') {
            $request->validate([
                'numero_tarjeta' => 'required|digits:16',
                'nombre_titular' => 'required|string|max:255',
                'vencimiento'    => 'required|string',
                'cvv'            => 'required|digits:3',
            ]);
        }

        if ($request->metodo_pago === 'yape' || $request->metodo_pago === 'plin') {
            $request->validate([
                'codigo_operacion' => 'required|string|max:50',
                'comprobante'      => 'nullable|image|max:10240',
            ]);
        }

        if ($request->metodo_pago === 'transferencia') {
            $request->validate([
                'comprobante' => 'nullable|image|max:10240',
            ]);
        }

        // Usuario y dirección
        $user = Auth::user();
        $direccion_envio_id = session('direccion_envio_id');

        if (!$direccion_envio_id) {
            return redirect()->route('checkout.envio')
                ->with('error', 'Por favor, completa la información de envío.');
        }

        // Calcular totales
        $items = CartItem::where('user_id', $user->id)->with('producto')->get();
        $subtotal = $items->sum(fn($i) => $i->producto->precio * $i->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $total = $subtotal + $igv + $envio;

        // Guardar comprobante si existe
        $comprobantePath = null;
        if ($request->hasFile('comprobante')) {
            $comprobantePath = $request->file('comprobante')->store('comprobantes', 'public');
        }

        // GUARDAR EN DB
        $pago = Pago::create([
            'user_id'            => $user->id,
            'direccion_envio_id' => $direccion_envio_id,
            'metodo_pago'        => $request->metodo_pago,
            'monto'              => $total,

            // Tarjeta
            'numero_tarjeta'     => $request->numero_tarjeta,
            'nombre_titular'     => $request->nombre_titular,
            'vencimiento'        => $request->vencimiento,
            'cvv'                => $request->cvv,

            // Yape / Plin
            'codigo_operacion'   => $request->codigo_operacion,

            // Comprobante
            'comprobante'        => $comprobantePath,

            // Estado
            'estado'             => $request->metodo_pago === 'tarjeta' ? 'pagado' : 'pendiente',
        ]);

        session(['pago_id' => $pago->id]);

        return redirect()->route('checkout.resumen')
            ->with('success', 'Pago realizado correctamente.');
    }

    // RESUNEN DE PEDIDO
   public function resumen()
{
    $user = Auth::user();

    // Recuperar ID de envío y pago
    $direccion_envio_id = session('direccion_envio_id');
    $pago_id = session('pago_id');

    if (!$direccion_envio_id || !$pago_id) {
        return redirect()->route('checkout.envio')
            ->with('error', 'Primero completa los pasos anteriores.');
    }

    // Recuperar modelos reales
    $direccion = DireccionEnvio::find($direccion_envio_id);
    $pago = Pago::find($pago_id);

    // Método de pago seleccionado
    $metodo_pago = $pago->metodo_pago;

    // Carrito del usuario
    $items = CartItem::with('producto')
        ->where('user_id', $user->id)
        ->get();

    // Calcular totales
    $subtotal = $items->sum(fn($i) => $i->producto->precio * $i->cantidad);
    $igv = $subtotal * 0.18;
    $envio = 10;
    $total = $subtotal + $igv + $envio;

    // RETURN FINAL
    return view('checkout.resumen', compact(
        'direccion',
        'pago',
        'metodo_pago',
        'items',
        'subtotal',
        'igv',
        'envio',
        'total'
    ));
}
    public function confirmarPedido()
    {
        $user = Auth::user();
    
        // 1. Obtener datos guardados en sesión
        $direccion_id = session('direccion_envio_id');
        $pago_id = session('pago_id');
    
        // Validación
        if (!$direccion_id || !$pago_id) {
            return redirect()->route('checkout.envio')
                ->with('error', 'Completa los pasos antes de confirmar el pedido.');
        }
    
        // 2. Obtener productos del carrito
        $cartItems = CartItem::with('producto')
            ->where('user_id', $user->id)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }
    
        // 3. Calcular montos
        $subtotal = $cartItems->sum(fn($item) => $item->producto->precio * $item->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $total = $subtotal + $igv + $envio;
    
        // 4. Crear código de seguimiento
        $codigo = 'DC-' . rand(100000, 999999);
    
        // 5. Crear el pedido
        $pedido = Pedido::create([
            'user_id' => $user->id,
            'pago_id' => $pago_id,
            'direccion_envio_id' => $direccion_id,
            'codigo_seguimiento' => $codigo,
            'subtotal' => $subtotal,
            'igv' => $igv,
            'envio' => $envio,
            'total' => $total,
            'estado' => 'pagado'
        ]);
    
        // 6. Guardar items del pedido
        foreach ($cartItems as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio' => $item->producto->precio
            ]);
        }
    
        // 7. Limpiar carrito
        CartItem::where('user_id', $user->id)->delete();
    
        // 8. Limpiar sesión
        session()->forget(['direccion_envio_id', 'pago_id']);
    
        // 9. Confirmación final
        return view('checkout.confirmacion', [
            'codigo_seguimiento' => $codigo
        ]);
    }



}
