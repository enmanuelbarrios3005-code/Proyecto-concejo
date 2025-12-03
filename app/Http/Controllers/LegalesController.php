<?php

namespace App\Http\Controllers;
use App\Models\Acuerdos;
use App\Models\Ordenanza;
use App\Models\Gaseta;
use App\Models\Resolucion; // Asegúrate de incluir el modelo Resolucion
use Illuminate\Http\Request;

class LegalesController extends Controller
{
    public function index()
    {
        $ordenanzas = Ordenanza::all();
        return view('web.ordenanzas.index', compact('ordenanzas'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $ordenanzas = Ordenanza::where('nombre', 'LIKE', "%{$query}%")
                                ->orWhere('fecha_importacion', 'LIKE', "%{$query}%")
                                ->get();
        return view('web.ordenanzas.index', compact('ordenanzas'));
    }

    public function showCetas()
    {
   $cetas = Gaseta::all();
        return view('web.gacetas.index', compact('cetas'));
    }

    public function searchCetas(Request $request)
    {
        $query = $request->input('query');
        $cetas = Gaseta::where('nombre', 'LIKE', "%{$query}%")
                                ->orWhere('fecha_importacion', 'LIKE', "%{$query}%")
                                ->get();
        return view('web.gacetas.index', compact('cetas'));
    }

    public function showResol()
    {
         $resol = Resolucion::all();
        return view('web.resoluciones.index', compact('resol'));
    }

    public function searchResol(Request $request)
    {
        $query = $request->input('query');
        $resol = Resolucion::where('nombre', 'LIKE', "%{$query}%")
                                ->orWhere('fecha_importacion', 'LIKE', "%{$query}%")
                                ->get();
        return view('web.resoluciones.index', compact('resol'));
    }
    public function showAcue()
    {
           $acue = Acuerdos::all();
        return view('web.acuerdos.index', compact('acue'));
        
    }

    public function searchAcue(Request $request)
    {
        $query = $request->input('query');
        $acue = acuerdos::where('nombre', 'LIKE', "%{$query}%")
                                ->orWhere('fecha_importacion', 'LIKE', "%{$query}%")
                                ->get();
        return view('web.acuerdos.index', compact('acue'));
    }
}



