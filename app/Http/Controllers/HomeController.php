<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;

class HomeController extends Controller
{
    public function index()
    {
        $resenas = Resena::with(['usuario', 'producto'])
            ->where('estado', 'aprobada')
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('resenas'));
    }
}
