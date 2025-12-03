<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para transacciones

class RequerimientoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo requerimiento.
     */
    public function create()
    {
        return view('requerimientos.create');
    }

    /**
     * Guarda el nuevo requerimiento y sus detalles en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación (puedes hacerla más estricta)
        $request->validate([
            'numero_requerimiento' => 'required|string',
            'oficina' => 'required|string',
            'fecha' => 'required|date',
            'descripcion.*' => 'required|string', // Valida que cada descripción exista
            'cantidad.*' => 'required|integer',  // Valida que cada cantidad exista
        ]);

        $requerimiento = null;

        // Usamos una transacción para asegurar que todo se guarde correctamente
        DB::transaction(function () use ($request, &$requerimiento) {
            
            // 1. Crear el Requerimiento principal
            $requerimiento = Requerimiento::create([
                'numero_requerimiento' => $request->numero_requerimiento,
                'oficina' => $request->oficina,
                'fecha' => $request->fecha,
                'elaborado_por_nombre' => $request->elaborado_por_nombre,
                'elaborado_por_cargo' => $request->elaborado_por_cargo,
                'recibido_por_nombre' => $request->recibido_por_nombre,
                'recibido_por_cargo' => $request->recibido_por_cargo,
            ]);

            // 2. Recorrer y guardar los detalles (la tabla)
            foreach ($request->cantidad as $index => $cantidad) {
                // Asegurarnos de que la fila tiene datos
                if (!empty($cantidad) && !empty($request->descripcion[$index])) {
                    $requerimiento->detalles()->create([
                        'cantidad' => $cantidad,
                        'descripcion' => $request->descripcion[$index],
                        'observaciones' => $request->observaciones[$index] ?? null,
                    ]);
                }
            }
        });

        // 3. Redirigir a la página de confirmación
        return redirect()->route('requerimientos.confirm', ['requerimiento' => $requerimiento->id])
                         ->with('success', 'Requerimiento guardado exitosamente.');
    }

    /**
     * Muestra la página de confirmación.
     */
    public function confirm(Requerimiento $requerimiento)
    {
        return view('requerimientos.confirm', compact('requerimiento'));
    }

    /**
     * Muestra la vista final (formato PDF) con botones de acción.
     */
    public function pdf(Requerimiento $requerimiento)
    {
        // Cargamos la relación 'detalles' para usarla en la vista
        $requerimiento->load('detalles'); 
        
        return view('requerimientos.pdf', compact('requerimiento'));
    }
}