<?php

namespace App\Http\Controllers;

use App\Models\Ordenanza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrdenanzasController extends Controller
{
   
    public function index(Request $request)
    {
        
        $query = $request->input('query');
        $categoria = $request->input('categoria');
        $fecha_aprobacion = $request->input('fecha_aprobacion');

        
        $ordenanzasQuery = Ordenanza::query();

        
        if ($query) {
            $ordenanzasQuery->where('nombre', 'LIKE', '%' . $query . '%');
        }

        if ($categoria && $categoria !== 'all') {
            $ordenanzasQuery->where('categoria', $categoria);
        }
        
        if ($fecha_aprobacion) {

            $ordenanzasQuery->whereDate('fecha_aprobacion', $fecha_aprobacion);
        }
        
       
        $ordenanzas = $ordenanzasQuery->get();

        
        $conteoOrdenanzas = $ordenanzas->count();

      
        $conteoMensual = $ordenanzas->groupBy(function ($item) {
            return Carbon::parse($item->fecha_aprobacion)->format('n');
        })->map(function ($month) {
            return $month->count();
        })->toArray();

        $conteoMensualCompleto = array_fill(0, 12, 0);
        foreach ($conteoMensual as $mes => $conteo) {
            $conteoMensualCompleto[$mes - 1] = $conteo;
        }

        return view('instrumentoslegales.ordenanzas.index', [
            'ordenanzas' => $ordenanzas,
            'conteoOrdenanzas' => $conteoOrdenanzas,
            'conteoMensual' => json_encode($conteoMensualCompleto),
        ]);
    }

   
    public function getConteoMensual(Request $request)
    {
        $year = $request->input('year');

        $conteoMensual = Ordenanza::selectRaw('MONTH(fecha_aprobacion) as mes, COUNT(*) as total')
            ->whereYear('fecha_aprobacion', $year)
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        $conteoCompleto = array_fill(0, 12, 0);
        foreach ($conteoMensual as $mes => $total) {
            $conteoCompleto[$mes - 1] = $total;
        }

        return response()->json(['conteoMensual' => $conteoCompleto]);
    }

   
    public function store(Request $request)
    {
        // Validar los datos del formulario, incluyendo los nuevos campos
        $request->validate([
            'ordenanza' => 'required|file|mimes:pdf|max:2048',
            'fecha_aprobacion' => 'required|date',
            'categoria' => 'required|string|max:255', // Nuevo campo de validación
        ]);
    
        if ($request->hasFile('ordenanza')) {
            $file = $request->file('ordenanza');
            $fileName = $file->getClientOriginalName();
    
            if (Ordenanza::where('nombre', $fileName)->exists()) {
                return redirect()->back()->with('error', 'Estimado usuario el documento ya existe en la base de datos.');
            }
    
            $file->storeAs('ordenanzas', $fileName, "public");
    
            $fechaImportacion = now();
            $fechaAprobacion = $request->input('fecha_aprobacion');
            $categoria = $request->input('categoria'); // Obtener el valor de la categoría
    
            Ordenanza::create([
                'nombre' => $fileName,
                'ruta' => 'ordenanzas/' . $fileName,
                'fecha_importacion' => $fechaImportacion,
                'fecha_aprobacion' => $fechaAprobacion,
                'categoria' => $categoria, // Guardar la categoría
            ]);
    
            return redirect()->back()->with('success', 'Documento cargado exitosamente.');
        }
    
        return redirect()->back()->with('error', 'Error al cargar el documento.');
    }

    /**
     * Elimina una ordenanza y su archivo.
     */
    public function destroy($fileName)
    {
        $filePath = 'ordenanzas/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            Ordenanza::where('nombre', $fileName)->delete();
            return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
        }

        abort(404, 'El documento no existe.');
    }

    /**
     * Descarga una ordenanza.
     */
    public function download($fileName)
    {
        $filePath = 'ordenanzas/' . $fileName;
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        abort(404, 'El documento no existe.');
    }
}
