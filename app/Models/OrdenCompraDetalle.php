<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    use HasFactory;
    protected $guarded = []; // Permitir asignación masiva

    public function ordenCompra()
    {
        return $this->belongsTo(OrdenCompra::class);
    }
}