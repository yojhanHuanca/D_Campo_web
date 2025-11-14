<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();


        $totalPedidos = 0; 

        return view('admin.dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'totalPedidos'
        ));

    }


}
