<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoAdminController extends Controller
{
    // LISTA DE PEDIDOS
    public function index(Request $request)
    {
        // Filtros del formulario
        $busqueda = $request->q ?? '';
        $estadoFiltro = $request->estado ?? 'todos';

        // Query base
        $query = Pedido::with('usuario')->orderBy('created_at', 'desc');

        // Filtro por texto (ID o código)
        if ($busqueda) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('codigo_seguimiento', 'like', "%{$busqueda}%")
                  ->orWhere('id', $busqueda);
            });
        }

        // Filtro por estado
        if ($estadoFiltro !== 'todos') {
            $query->where('estado', $estadoFiltro);
        }

        // Lista de pedidos para la tabla
        $pedidos = $query->get();

        // 👉 CONTADORES PARA LAS TARJETAS
        $totalPedidos = Pedido::count();
        $pendientes   = Pedido::where('estado', 'pendiente')->count();
        // En tu enum los "empaquetados" son los pagados
        $empaquetados = Pedido::where('estado', 'pagado')->count();
        // En tu enum el "en tránsito" es 'enviado'
        $enTransito   = Pedido::where('estado', 'enviado')->count();
        $entregados   = Pedido::where('estado', 'entregado')->count();

        return view('admin.pedidos.index', compact(
            'pedidos',
            'busqueda',
            'estadoFiltro',
            'totalPedidos',
            'pendientes',
            'empaquetados',
            'enTransito',
            'entregados'
        ));
    }


    // MOSTRAR DETALLE DEL PEDIDO
    public function show($id)
    {
        $pedido = Pedido::with(['items.producto', 'usuario'])
            ->findOrFail($id);

        return view('admin.pedidos.show', compact('pedido'));
    }

    // CAMBIAR ESTADO
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()
            ->back()
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }

    
    
}
