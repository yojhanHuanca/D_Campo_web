<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsultaSoporte;
use App\Models\RespuestaSoporte;
use App\Services\IASoporteService;
use App\Models\Pedido;

class AdminSoporteController extends Controller
{
    public function index()
    {
        $consultas = ConsultaSoporte::with(['user', 'respuestas'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Agrupar por usuario para mostrar un hilo único y contar pendientes
        $threads = $consultas->groupBy('user_id')->map(function ($items) {
            $ultimo = $items->first(); // ya viene ordenado desc
            return [
                'ultimo' => $ultimo,
                'pendientes' => $items->where('estado', 'pendiente')->count(),
            ];
        });

        return view('admin.soporte.index', [
            'threads' => $threads,
        ]);
    }

    public function show($id)
    {
        $consulta = ConsultaSoporte::with(['user', 'respuestas.user'])
            ->findOrFail($id);

        return view('admin.soporte.show', [
            'consulta' => $consulta,
        ]);
    }

    public function responder(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $consulta = ConsultaSoporte::findOrFail($id);

        RespuestaSoporte::create([
            'consulta_soporte_id' => $consulta->id,
            'user_id'             => Auth::id(),
            'origen'              => 'manual',
            'contenido'           => $request->respuesta,
        ]);

        $consulta->estado = 'respondido';
        $consulta->save();

        return back()->with('success', 'Respuesta registrada.');
    }

    public function generarIA($id, IASoporteService $iaService)
    {
        $consulta = ConsultaSoporte::with('user')->findOrFail($id);

        $pedidos = [];
        if ($consulta->user) {
            $pedidos = Pedido::where('user_id', $consulta->user->id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get()
                ->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'fecha' => $p->created_at?->format('d/m/Y'),
                        'total' => $p->total,
                        'estado' => $p->estado,
                    ];
                })
                ->toArray();
        }

        $contexto = [
            'pregunta' => $consulta->mensaje,
            'politicas' => 'Sé cordial, breve y ofrece soluciones accionables. Si es un reclamo, pide disculpas y ofrece seguimiento.',
            'horario' => 'Lunes a sábado 9am - 6pm (GMT-5).',
            'faq' => [
                'Tiempo de entrega: 2-3 días hábiles en Lima, 3-5 en provincias.',
                'Cambios y devoluciones: 7 días calendario con comprobante.',
                'Pagos: tarjeta, Yape, Plin y transferencia.',
            ],
            'productos' => [
                ['nombre' => 'Boxes D’Campo', 'descripcion' => 'Cajas de productos orgánicos seleccionados.'],
                ['nombre' => 'Quesos artesanales', 'descripcion' => 'Elaborados en granja, maduración natural.'],
            ],
            'pedidos' => $pedidos,
            'estado_pedido' => $pedidos[0]['estado'] ?? '',
        ];

        $respuestaIA = $iaService->generarRespuesta($contexto);

        RespuestaSoporte::create([
            'consulta_soporte_id' => $consulta->id,
            'user_id'             => Auth::id(),
            'origen'              => 'ia',
            'contenido'           => $respuestaIA,
        ]);

        $consulta->estado = 'respondido';
        $consulta->save();

        return back()->with('success', 'Respuesta generada con IA.');
    }
}
