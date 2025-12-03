<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token de verificación inválido.'], 404);
        }

        $user->update([
            'verification_token' => null,
            'email_verified_at' => now(),
        ]);

        return response()->json(['message' => 'Correo verificado. Ahora puedes iniciar sesión.']);
    }
}
