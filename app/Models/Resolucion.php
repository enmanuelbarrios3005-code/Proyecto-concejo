<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    use HasFactory;
    
    protected $table = 'resoluciones'; // Asegúrate de que esta línea está presente
    protected $fillable = ['nombre', 'ruta', 'fecha_importacion', 'fecha_aprobacion', 'categoria']; 
    
}

