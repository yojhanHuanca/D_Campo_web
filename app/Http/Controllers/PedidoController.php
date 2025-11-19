<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;


class PedidoController extends Controller
{
    //LISTAR PEDIDOS DE USUARIOS
    public function index()
    {
        $pedidos = pedido::where('user_id', Auth::id())
            ->with('items.producto')
            ->latest()
            ->get();

        return view('perfil.pedidos', compact('pedidos'));
    }

    //VER DETALLES DEL PEDIDO
    public function show($id)
    {
        $pedido = Pedido::where('id', $id)->where('user_id', Auth::id())->with('items.producto')->firstOrFail();

        return view('perfil.pedidos_detalle', compact('pedido'));

    }

    public function descargarBoleta($id)
    {
        $pedido = Pedido::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['items.producto', 'usuario'])
            ->firstOrFail();
            
        $pdf = Pdf::loadView('pdf.boleta', compact('pedido'))
            ->setPaper('A4', 'portrait');
    
        $nombreArchivo = 'Boleta-DC-' . $pedido->id . '.pdf';
    
        return $pdf->download($nombreArchivo);
    }

    
   
}
