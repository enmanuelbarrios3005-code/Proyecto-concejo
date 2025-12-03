<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\SugerenciaRecibida;

class SugerenciaController extends Controller
{
    public function enviarSugerenciaAjax(Request $request)
    {
        // 1. Validar los datos (solo mensaje es obligatorio en este ejemplo)
        $validator = Validator::make($request->all(), [
            'mensaje' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            // Devuelve errores de validación con código 422
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Lógica de Envío de Correo
        try {
            // Define el correo al que quieres recibir la sugerencia
            $correoDestino = 'enmanuelbarrios3005@gmail.com';

            Mail::to($correoDestino)->send(new SugerenciaRecibida($request->all()));
            
            // 3. Respuesta de éxito para AJAX
            return response()->json(['success' => '¡Sugerencia enviada con éxito!'], 200);

        } catch (\Exception $e) {
            // Loguear el error para debug
            // \Log::error('Error al enviar sugerencia: ' . $e->getMessage()); 

            // 4. Respuesta de error para AJAX
            return response()->json(['error' => 'Error interno al enviar el correo.'], 500);
        }
    }
}