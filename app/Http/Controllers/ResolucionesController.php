<?php
namespace App\Http\Controllers;

use App\Models\Resolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ResolucionesController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
    $categoria = $request->input('categoria');
    $fecha_aprobacion = $request->input('fecha_aprobacion');

    $resolucionesQuery = Resolucion::query();

    if ($query) {
        $resolucionesQuery->where('nombre', 'LIKE', '%' . $query . '%');
    }

    if ($categoria && $categoria !== 'all') {
        $resolucionesQuery->where('categoria', $categoria);
    }

    if ($fecha_aprobacion) {
        $resolucionesQuery->whereDate('fecha_aprobacion', $fecha_aprobacion);
    }

    $resoluciones = $resolucionesQuery->get();
    $conteoResoluciones = $resoluciones->count();

    $conteoMensual = $resoluciones->groupBy(function ($item) {
        return Carbon::parse($item->fecha_aprobacion)->format('n');
    })->map(function ($month) {
        return $month->count();
    })->toArray();

    $conteoMensualCompleto = array_fill(0, 12, 0);
    foreach ($conteoMensual as $mes => $conteo) {
        $conteoMensualCompleto[$mes - 1] = $conteo;
    }

    return view('instrumentoslegales.resoluciones.index', [
        'resoluciones' => $resoluciones,
        'conteoResoluciones' => $conteoResoluciones,
        'conteoMensual' => json_encode($conteoMensualCompleto),
    ]);
}

    public function obtenerConteoMensualPorAnio(Request $request)
    {
        $anio = $request->input('anio');

        $conteoPorMes = Resolucion::selectRaw('MONTH(fecha_aprobacion) as mes, COUNT(*) as total')
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
            'resolucion' => 'required|file|mimes:pdf|max:2048',
            'fecha_aprobacion' => 'required|date',
             'categoria' => 'required|string|max:255'
        ]);

        if ($request->hasFile('resolucion')) {
            $file = $request->file('resolucion');
            $fileName = $file->getClientOriginalName();

            if (Resolucion::where('nombre', $fileName)->exists()) {
                return redirect()->back()->with('error', 'Estimado usuario el documento ya existe en la base de datos.');
            }

            $file->storeAs('/resoluciones', $fileName);

            $fechaImportacion = now();
            $fechaAprobacion = $request->input('fecha_aprobacion');
            $categoria = $request->input('categoria');

            Resolucion::create([
                'nombre' => $fileName,
                'ruta' => 'resoluciones/' . $fileName,
                'fecha_importacion' => $fechaImportacion,
                'fecha_aprobacion' => $fechaAprobacion,
                'categoria' => $categoria,
            ]);

            return redirect()->back()->with('success', 'Documento cargado exitosamente.');
        }

        return redirect()->back()->with('error', 'Error al cargar el documento.');
    }

    public function destroy($fileName)
    {
        $filePath = '/resoluciones/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            Resolucion::where('nombre', $fileName)->delete();
            return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }

    public function download($fileName)
    {
        $filePath = '/resoluciones/' . $fileName;
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }
}
