<?php

namespace App\Http\Controllers;

use App\Models\Gaseta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GasetasController extends Controller
{

    public function index(Request $request)
{
    $query = $request->input('query');
    $categoria = $request->input('categoria');
    $fecha_aprobacion = $request->input('fecha_aprobacion');

    $gasetasQuery = Gaseta::query();

    if ($query) {
        $gasetasQuery->where('nombre', 'LIKE', '%' . $query . '%');
    }

    if ($categoria && $categoria !== 'all') {
        $gasetasQuery->where('categoria', $categoria);
    }

    if ($fecha_aprobacion) {
        $gasetasQuery->whereDate('fecha_aprobacion', $fecha_aprobacion);
    }

    $gasetas = $gasetasQuery->get();
    $conteoGasetas = $gasetas->count();

    $conteoMensual = $gasetas->groupBy(function ($item) {
        return Carbon::parse($item->fecha_aprobacion)->format('n');
    })->map(function ($month) {
        return $month->count();
    })->toArray();

    $conteoMensualCompleto = array_fill(0, 12, 0);
    foreach ($conteoMensual as $mes => $conteo) {
        $conteoMensualCompleto[$mes - 1] = $conteo;
    }

    return view('instrumentoslegales.gasetas.index', [
        'gasetas' => $gasetas,
        'conteoGasetas' => $conteoGasetas,
        'conteoMensual' => json_encode($conteoMensualCompleto),
    ]);
}
    public function obtenerConteoMensual(Request $request)
    {
        $anio = $request->input('anio');

        $conteoPorMes = Gaseta::selectRaw('MONTH(fecha_aprobacion) as mes, COUNT(*) as total')
            ->whereYear('fecha_aprobacion', $anio)
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        for ($i = 1; $i <= 12; $i++) {
            if (!isset($conteoPorMes[$i])) {
                $conteoPorMes[$i] = 0;
            }
        }

        ksort($conteoPorMes);

        return response()->json(['conteoMensual' => array_values($conteoPorMes)]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'gaseta' => 'required|file|mimes:pdf|max:2048', // Solo permite archivos PDF
            'fecha_aprobacion' => 'required|date', // Validar la fecha de aprobación
             'categoria' => 'required|string|max:255'
        ]);
    
        if ($request->hasFile('gaseta')) {
            $file = $request->file('gaseta');
            $fileName = $file->getClientOriginalName(); // Mantener el nombre original del archivo
    
            // Verificar si el archivo ya existe en la base de datos
            if (Gaseta::where('nombre', $fileName)->exists()) {
                return redirect()->back()->with('error', 'Estimado usuario el documento ya existe en la base de datos.');
            }
    
            $file->storeAs('/gasetas', $fileName);
    
            // Guardar las fechas en el formato completo incluyendo año, mes, día, hora, minutos y segundos
            $fechaImportacion = now();
            $fechaAprobacion = $request->input('fecha_aprobacion');
            $categoria = $request->input('categoria'); // Asignar una categoría predeterminada si no se proporciona
    
            Gaseta::create([
                'nombre' => $fileName,
                'ruta' => 'gasetas/' . $fileName,
                'fecha_importacion' => $fechaImportacion, // Guardar la fecha de importación
                'fecha_aprobacion' => $fechaAprobacion, // Guardar la fecha de aprobación
                'categoria' => $categoria, // Asignar una categoría predeterminada
            ]);
    
            return redirect()->back()->with('success', 'Documento cargado exitosamente.');
        }
    
        return redirect()->back()->with('error', 'Error al cargar el documento.');
    }

    public function destroy($fileName)
    {
        $filePath = '/gasetas/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            Gaseta::where('nombre', $fileName)->delete();
            return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }

    public function download($fileName)
    {
        $filePath = '/gasetas/' . $fileName;
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }

}
