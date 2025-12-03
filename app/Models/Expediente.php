<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $table = 'expedientes';

    protected $fillable = [
        'cedula',
        'telefono',
        'numero_cuenta',
        'fecha_ingreso',
        'user_id',
        'imagen',
        'archivo',
        'estado',
        'cargo', // Add the cargo field here
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Documento
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}