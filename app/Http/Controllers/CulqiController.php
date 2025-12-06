<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Pago;
use App\Models\CartItem;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Cupon;

class CulqiController extends Controller
{
    public function procesarPago(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login.form')->with('error', 'Debes iniciar sesión para pagar.');
        }

        $direccionEnvioId = session('direccion_envio_id');

        if (!$direccionEnvioId) {
            return redirect()->route('checkout.envio')->with('error', 'Falta la información de envío.');
        }

        $items = CartItem::with('producto')->where('user_id', $user->id)->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Validar stock y productos existentes
        foreach ($items as $item) {
            if (!$item->producto || $item->producto->stock < $item->cantidad) {
                return redirect()->route('cart.index')
                    ->with('error', 'Stock insuficiente para ' . ($item->producto->nombre ?? 'un producto del carrito') . '.');
            }
        }

        $subtotal = $items->sum(fn($item) => $item->producto->precio * $item->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $descuento = 0;

        // Validar cupon en servidor si existe
        $cuponId = session('cupon_id');
        if ($cuponId) {
            $cupon = Cupon::where('id', $cuponId)
                ->where('activo', 1)
                ->where(function ($q) {
                    $q->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', now()->toDateString());
                })
                ->first();

            if ($cupon && (is_null($cupon->limite_uso) || $cupon->usos_realizados < $cupon->limite_uso)) {
                if ($cupon->compra_minima === null || $subtotal >= $cupon->compra_minima) {
                    $descuento = $cupon->tipo === 'porcentaje'
                        ? ($subtotal * ($cupon->valor / 100))
                        : $cupon->valor;
                }
            } else {
                // Cupón inválido, limpiar sesión
                session()->forget(['cupon_id', 'cupon_codigo', 'cupon_descuento']);
            }
        }

        $total = max(0, ($subtotal + $igv + $envio) - $descuento);

        // Realizar el cobro en Culqi API usando la SECRET_KEY
        $secretKey = env('CULQI_SECRET_KEY');
        $response = Http::withBasicAuth($secretKey, '')
            ->post('https://api.culqi.com/v2/charges', [
                'amount' => intval($total * 100),
                'currency_code' => 'PEN',
                'description' => "Pago D'Campo por usuario ID: {$user->id}",
                'capture' => true,
                'source_id' => $request->token,
            ]);

        if ($response->failed()) {
            Log::error('Error en Culqi API: ' . $response->body());
            return redirect()->back()->with('error', 'Error procesando el pago en Culqi: ' . $response->json('user_message', 'Error desconocido'));
        }

        $charge = $response->json();

        if (!isset($charge['paid']) || $charge['paid'] !== true) {
            return redirect()->back()->with('error', 'El pago no fue aprobado por Culqi.');
        }

        DB::beginTransaction();
        try {
            // Crear registro de pago con estado pagado
            $pago = Pago::create([
                'user_id' => $user->id,
                'direccion_envio_id' => $direccionEnvioId,
                'metodo_pago' => 'tarjeta',
                'monto' => $total,
                'estado' => 'pagado',
                'codigo_operacion' => $charge['id'] ?? substr($request->token, -8),
                'numero_tarjeta' => null,
                'nombre_titular' => null,
                'vencimiento' => null,
                'cvv' => null,
                'comprobante' => null,
            ]);

            $pedido = Pedido::create([
                'user_id' => $user->id,
                'direccion_envio_id' => $direccionEnvioId,
                'pago_id' => $pago->id,
                'estado' => 'pagado',
                'total' => $total,
                'subtotal' => $subtotal,
                'igv' => $igv,
                'envio' => $envio,
                'metodo_pago' => 'tarjeta',
                'codigo_operacion' => $pago->codigo_operacion,
                'codigo_seguimiento' => 'DC-' . rand(100000, 999999),
                'cupon_id' => $cuponId ?? null,
                'codigo_cupon' => session('cupon_codigo'),
                'descuento' => $descuento,
            ]);

            foreach ($items as $item) {
                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto->id,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->producto->precio,
                ]);

                $item->producto->decrement('stock', $item->cantidad);
            }

            // Registrar uso de cupón
            if (isset($cupon) && $cuponId) {
                DB::table('cupon_usuario')->insert([
                    'user_id' => $user->id,
                    'cupon_id' => $cuponId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $cupon->increment('usos_realizados');
                $cupon->refresh();
                if (!is_null($cupon->limite_uso) && $cupon->usos_realizados >= $cupon->limite_uso) {
                    $cupon->activo = 0;
                    $cupon->save();
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error guardando pedido/pago post Culqi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar el pedido luego del pago.');
        }

        // Limpiar carrito y sesiones
        CartItem::where('user_id', $user->id)->delete();
        session([
            'pago_id' => $pago->id,
            'cupon_id' => null,
            'cupon_codigo' => null,
            'cupon_descuento' => null,
        ]);

        return redirect()->route('checkout.resumen')->with('success', 'Pago procesado correctamente.');
    }
}
