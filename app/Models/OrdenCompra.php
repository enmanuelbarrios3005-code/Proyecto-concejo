<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;
    protected $guarded = []; // Permitir asignación masiva

    public function detalles()
    {
        return $this->hasMany(OrdenCompraDetalle::class);
    }

    public function requerimiento()
    {
        return $this->belongsTo(Requerimiento::class);
    }
}