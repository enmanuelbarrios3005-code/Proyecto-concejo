<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ruta', 'expediente_id', 'tipo', 'fecha'];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
