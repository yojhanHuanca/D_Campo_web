<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

        $subtotal = $items->sum(fn($item) => $item->producto->precio * $item->cantidad);
        $igv = $subtotal * 0.18;
        $envio = 10;
        $descuento = session('cupon_descuento', 0);
        $total = ($subtotal + $igv + $envio) - $descuento;

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

        session(['pago_id' => $pago->id]);

        return redirect()->route('checkout.resumen')->with('success', 'Pago procesado correctamente.');
    }
}
