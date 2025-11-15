<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Enviar correo
        Mail::raw(
            "Mensaje de: {$request->name}\nEmail: {$request->email}\n\n{$request->message}",
            function ($msg) use ($request) {
                $msg->to('contacto.dcampo.pe@gmail.com')
                    ->subject('Nuevo mensaje desde el formulario de contacto');
            }
        );

        return back()->with('success', 'Mensaje enviado correctamente. ¡Gracias por contactarnos!');
    }
}
