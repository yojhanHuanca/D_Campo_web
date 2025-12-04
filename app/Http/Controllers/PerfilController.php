<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ConsultaSoporte;
use App\Models\RespuestaSoporte;


class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cantidad de pedidos del usuario
        $totalPedidos = Pedido::where('user_id', $user->id)->count();

        // Favoritos 
        $totalFavoritos = $user->favoritos()->count();

        return view('perfil.index', compact(
            'user',
            'totalPedidos',
            'totalFavoritos'
        ));
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

    
        /** @var \App\Models\User $user */
        $user = Auth::user();
    
        $user->name = $request->name;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
    
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Datos actualizados correctamente.',
            'name' => $user->name,
            'telefono' => $user->telefono,
            'direccion' => $user->direccion
        ]);       
    }



    public function cambiarPassword(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'password_actual' => 'required',
            'nueva_password' => 'required|min:6|confirmed'
        ]);
    
        // 2. Obtener usuario autenticado
        $user = Auth::user();
    
        // 3. Verificar contraseña actual
        if (!Hash::check($request->password_actual, $user->password)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual es incorrecta.']);
        }
    
        // 4. Guardar nueva contraseña
        $user->password = Hash::make($request->nueva_password);
        $user->save();
    
        // 5. Respuesta
        return back()->with('success', 'Contraseña actualizada correctamente.');
    }

    public function asesoria(Request $request)
    {
        $user = Auth::user();

        $consultas = ConsultaSoporte::with(['respuestas.user'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $consultaActiva = null;
        if ($consultas->isNotEmpty()) {
            $consultaActiva = $consultas->firstWhere('id', $request->query('consulta'));
            if (!$consultaActiva) {
                $consultaActiva = $consultas->first();
            }
        }
    
        return view('perfil.asesoria', compact('user', 'consultas', 'consultaActiva'));
    }
    
    public function enviarConsulta(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:50',
            'asunto'    => 'required|string|max:255',
            'mensaje'   => 'required|string|max:1000',
            'email'     => 'required|email|max:255',
        ]);
    
        ConsultaSoporte::create([
            'user_id'       => Auth::id(),
            'categoria'     => $request->categoria,
            'asunto'        => $request->asunto,
            'mensaje'       => $request->mensaje,
            'email_contacto'=> $request->email,
            'estado'        => 'pendiente',
        ]);
    
        return back()->with('success', 'Tu consulta fue enviada. Te responderemos lo antes posible.');
    }

    public function responderConsulta(Request $request, $id)
    {
        $request->validate([
            'mensaje' => 'required|string|max:1000',
        ]);

        $consulta = ConsultaSoporte::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        RespuestaSoporte::create([
            'consulta_soporte_id' => $consulta->id,
            'user_id'             => Auth::id(),
            'origen'              => 'usuario',
            'contenido'           => $request->mensaje,
        ]);

        $consulta->estado = 'pendiente';
        $consulta->save();

        return back()->with('success', 'Mensaje enviado al soporte.');
    }
    
    
    
}
    
