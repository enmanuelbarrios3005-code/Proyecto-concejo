<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index', compact('documentos'));
    }

    public function importar(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'expediente_id' => 'required|exists:expedientes,id',
            'documentos.*' => 'required|file|mimes:pdf,doc,docx,txt|max:2048', // Tamaño máximo de 2MB
        ]);

        // Manejo de la importación de documentos
        try {
            foreach ($request->file('documentos') as $archivo) {
                $nombreOriginal = $archivo->getClientOriginalName();
                $ruta = $archivo->storeAs('documentos', $nombreOriginal, 'public');
                
                // Crear el registro en la base de datos
                Documento::create([
                    'nombre' => $nombreOriginal,
                    'ruta' => $ruta,
                    'expediente_id' => $request->expediente_id,
                ]);
            }

            // Redirigir con un mensaje de éxito
            return redirect()->route('expedientes.index', $request->expediente_id)
                ->with('success', 'Documentos importados correctamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return redirect()->back()->with('error', 'Error al importar los documentos: ' . $e->getMessage());
        }
    }

    public function obtenerDocumentos($id)
{
    $documentos = Documento::where('expediente_id', $id)->get();

    // Añadir la URL completa para el frontend
    $documentos->each(function($documento) {
        $documento->ruta = asset('storage/' . $documento->ruta); // Asegúrate de que la ruta sea correcta
    });

    return response()->json($documentos);
}

public function eliminar($id)
{
    $documento = Documento::find($id);
    if ($documento) {
        Storage::delete($documento->ruta); // Asegúrate de que la ruta sea correcta
        $documento->delete();
        return response()->json(['message' => 'Documento eliminado correctamente.']);
    }
    return response()->json(['message' => 'Documento no encontrado.'], 404);
}


   

    public function filtrar(Request $request)
    {
        $documentos = Documento::query()
            ->when($request->input('nombre'), function($query, $name) {
                return $query->where('nombre', 'like', '%' . $name . '%');
            })
            ->when($request->input('tipo'), function($query, $type) {
                return $query->where('tipo', $type);
            })
            ->get(['tipo', 'nombre', 'ruta']); // Asegúrate de que 'ruta' es el campo correcto
    
        // Añadir la URL completa para el frontend
        $documentos->each(function($documento) {
            $documento->url = asset('storage/' . $documento->ruta);
        });
    
        return response()->json($documentos);
    }
    
}