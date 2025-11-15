<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Enviar correo a tu bandeja
        Mail::raw(
            "Nuevo suscriptor del newsletter:\n\nEmail: {$request->email}",
            function ($msg) {
                $msg->to('contacto.dcampo.pe@gmail.com')
                    ->subject("Nueva suscripción al Newsletter – D'Campo");
            }
        );

        return back()->with('success', '¡Gracias por suscribirte! Pronto recibirás nuestras novedades 😊');
    }
}
