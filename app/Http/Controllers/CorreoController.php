<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    public function enviarCorreo()
    {
        Mail::raw('Este es un correo de prueba enviado desde Laravel usando Mailtrap', function ($message) {
            $message->from('cesarguillenmatos@gmail.com', 'Tu Aplicación');
            $message->to('destinatario@example.com')->subject('Correo de Prueba');
        });

        return response()->json(['message' => 'Correo enviado con éxito']);
    }
}
