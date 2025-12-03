<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordRule implements Rule
{
    protected $message;

    public function passes($attribute, $value)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Validación regex para contraseñas
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.$\/\-*#=@])[A-Za-z\d.$\/\-*#=@]{10,}$/';

        // No permitir más de una letra mayúscula
        $hasOneUppercase = preg_match_all('/[A-Z]/', $value) === 1;

        // Asegurarse de que la nueva contraseña no sea igual a la actual
        if (Hash::check($value, $user->password)) {
            $this->message = 'La nueva contraseña no puede ser igual a la contraseña actual.';
            return false;
        }

        if (!preg_match($regex, $value)) {
            $this->message = 'La contraseña no cumple con el formato solicitado.';
            return false;
        }

        if (!$hasOneUppercase) {
            $this->message = 'La contraseña debe contener exactamente una letra mayúscula.';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
?>
