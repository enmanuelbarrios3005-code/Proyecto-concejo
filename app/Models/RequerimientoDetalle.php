<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoDetalle extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Un detalle pertenece a un requerimiento.
     */
    public function requerimiento()
    {
        return $this->belongsTo(Requerimiento::class);
    }
}