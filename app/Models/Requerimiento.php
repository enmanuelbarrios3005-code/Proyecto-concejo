<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    use HasFactory;

    // Permite la asignación masiva de estos campos
    protected $guarded = [];

    /**
     * Un requerimiento tiene muchos detalles.
     */
    public function detalles()
    {
        return $this->hasMany(RequerimientoDetalle::class);
    }
}