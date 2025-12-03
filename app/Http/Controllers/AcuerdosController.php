<?php
namespace App\Http\Controllers;

use App\Models\Acuerdos; // Cambiado a Acuerdos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AcuerdosController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');
    $categoria = $request->input('categoria');
    $fecha_aprobacion = $request->input('fecha_aprobacion');

    $acuerdosQuery = Acuerdos::query();

    if ($query) {
        $acuerdosQuery->where('nombre', 'LIKE', '%' . $query . '%');
    }

    if ($categoria && $categoria !== 'all') {
        $acuerdosQuery->where('categoria', $categoria);
    }

    if ($fecha_aprobacion) {
        $acuerdosQuery->whereDate('fecha_aprobacion', $fecha_aprobacion);
    }

    $acuerdos = $acuerdosQuery->get();
    $conteoAcuerdos = $acuerdos->count();

    $conteoMensual = $acuerdos->groupBy(function ($item) {
        return Carbon::parse($item->fecha_aprobacion)->format('n');
    })->map(function ($month) {
        return $month->count();
    })->toArray();

    $conteoMensualCompleto = array_fill(0, 12, 0);
    foreach ($conteoMensual as $mes => $conteo) {
        $conteoMensualCompleto[$mes - 1] = $conteo;
    }

    return view('instrumentoslegales.acuerdos.index', [
        'acuerdos' => $acuerdos,
        'conteoAcuerdos' => $conteoAcuerdos,
        'conteoMensual' => json_encode($conteoMensualCompleto),
    ]);
}
    public function obtenerConteoMensualAcuerdosPorAnio(Request $request) // Cambiado a obtenerConteoMensualAcuerdosPorAnio
    {
        $anio = $request->input('anio');

        $conteoPorMesAcuerdos = Acuerdos::selectRaw('MONTH(fecha_aprobacion) as mes, COUNT(*) as total') // Cambiado a Acuerdos
            ->whereYear('fecha_aprobacion', $anio) // Cambiado a fecha_aprobacion
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        for ($i = 1; $i <= 12; $i++) {
            if (!isset($conteoPorMesAcuerdos[$i])) { // Cambiado a acuerdos
                $conteoPorMesAcuerdos[$i] = 0; // Cambiado a acuerdos
            }
        }

        ksort($conteoPorMesAcuerdos); // Cambiado a acuerdos

        return response()->json(['conteoMensual' => array_values($conteoPorMesAcuerdos)]); // Cambiado a acuerdos
    }

    public function store(Request $request)
    {
        $request->validate([
            'acuerdo' => 'required|file|mimes:pdf|max:2048', // Cambiado a acuerdo
            'fecha_aprobacion' => 'required|date', // Cambiado a fecha_aprobacion
             'categoria' => 'required|string|max:255'
        ]);

        if ($request->hasFile('acuerdo')) { // Cambiado a acuerdo
            $file = $request->file('acuerdo'); // Cambiado a acuerdo
            $fileName = $file->getClientOriginalName(); // Cambiado a acuerdo

            if (Acuerdos::where('nombre', $fileName)->exists()) { // Cambiado a Acuerdos
                return redirect()->back()->with('error', 'Estimado usuario el documento ya existe en la base de datos.');
            }

            $file->storeAs('/acuerdos', $fileName); // Cambiado a acuerdos

            $fechaImportacion = now(); // Cambiado a fecha_importacion
            $fechaAprobacion = $request->input('fecha_aprobacion'); // Cambiado a fecha_aprobacion
            $categoria = $request->input('categoria'); // Nuevo campo de categoría

            Acuerdos::create([
                'nombre' => $fileName, // Cambiado a acuerdos
                'ruta' => 'acuerdos/' . $fileName, // Cambiado a acuerdos
                'fecha_importacion' => $fechaImportacion, // Cambiado a fecha_importacion
                'fecha_aprobacion' => $fechaAprobacion, // Cambiado a fecha_aprobacion
                'categoria' => $categoria, // Guardar la categoría
            ]);

            return redirect()->back()->with('success', 'Documento cargado exitosamente.');
        }

        return redirect()->back()->with('error', 'Error al cargar el documento.');
    }

    public function destroy($fileName)
    {
        $filePath = '/acuerdos/' . $fileName; // Cambiado a acuerdos
        if (Storage::exists($filePath)) {
            Storage::delete($filePath); // Cambiado a acuerdos
            Acuerdos::where('nombre', $fileName)->delete(); // Cambiado a Acuerdos
            return redirect()->back()->with('success', 'Documento eliminado exitosamente.');
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }

    public function download($fileName)
    {
        $filePath = '/acuerdos/' . $fileName; // Cambiado a acuerdos
        if (Storage::exists($filePath)) {
            return Storage::download($filePath); // Cambiado a acuerdos
        }

        return redirect()->back()->with('error', 'El documento no existe.');
    }
}
