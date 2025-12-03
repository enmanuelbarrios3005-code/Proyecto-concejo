<?php
namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all(); // O ajusta la consulta según necesites
        return response()->json($eventos);
    }
}
