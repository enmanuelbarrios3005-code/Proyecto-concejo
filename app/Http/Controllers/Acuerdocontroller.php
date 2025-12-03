<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento; // Asume que el modelo se llama 'Documento'

class AcuerdoController extends Controller
{
    // ... otros métodos ...

    /**
     * Filtra documentos leyendo 'tipo' y 'categoria' de la Query String (Request).
     * * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        // 1. Obtener los parámetros de la Query String
        // Si no se encuentran, se usa 'null' como valor por defecto.
        $tipo = $request->input('tipo'); 
        $categoria = $request->input('categoria');

        // 2. Comprobar que al menos uno de los filtros existe
        if (is_null($tipo) && is_null($categoria)) {
            // Si no hay filtros, se podría redirigir a 'Ver Todas' o mostrar un error.
            return redirect()->route('legales')->with('error', 'Debes seleccionar al menos un criterio de filtrado.');
        }

        // 3. Iniciar la consulta
        $query = Documento::query();

        // 4. Aplicar el filtro 'tipo' si existe
        if (!is_null($tipo)) {
            $query->where('tipo', $tipo);
        }

        // 5. Aplicar el filtro 'categoria' si existe
        if (!is_null($categoria)) {
            // Manejamos el reemplazo de caracteres si es necesario
            $categoriaLimpia = str_replace('_', ' ', $categoria);
            $query->where('categoria', $categoriaLimpia);
        }

        // 6. Ejecutar la consulta y paginar
        $documentos = $query->paginate(15);
        
        // 7. Preparar el mensaje de filtro activo
        $filtroActivo = [];
        if (!is_null($tipo)) $filtroActivo[] = "Tipo: $tipo";
        if (!is_null($categoria)) $filtroActivo[] = "Categoría: $categoria";
        $filtroActivo = implode(', ', $filtroActivo);


        // 8. Pasar los datos a la vista
        return view('documentos.index', [
            'documentos' => $documentos,
            'filtro_activo' => $filtroActivo
        ]);
    }
    
    // ... otros métodos ...
}