<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Pedido;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalPedidos = Pedido::count();
        $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();
        $ingresosTotales = Pedido::whereIn('estado', ['pagado', 'entregado'])
            ->sum('total');
        
         $pedidosRecientes = Pedido::with('usuario')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        

        return view('admin.dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'totalPedidos',
            'pedidosPendientes',
            'ingresosTotales',
            'pedidosRecientes'
        ));

    }


}
