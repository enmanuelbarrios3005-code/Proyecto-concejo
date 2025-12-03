<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'apellido',
        'nivel_de_acceso',
        'password',
        'protected', // Añadir este campo
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function expediente()
    {
        return $this->hasOne(Expediente::class);
    }
    public function imagens()
    {
        return $this->hasMany(Imagens::class);
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->protected) {
                throw new \Exception('No puedes eliminar al superadministrador.');
            }
        });
    }
}
