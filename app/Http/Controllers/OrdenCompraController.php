<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
use App\Models\Requerimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenCompraController extends Controller
{
    /**
     * Muestra el formulario de crear orden, pre-llenado con datos de un requerimiento.
     */
    public function createFromRequerimiento(Requerimiento $requerimiento)
    {
        $requerimiento->load('detalles');
        
        // Devolvemos la vista 'create', pasándole el requerimiento
        return view('ordencompra.create', compact('requerimiento'));
    }

    /**
     * Guarda la nueva orden de pago y sus detalles.
     */
    public function store(Request $request)
    {
        // Validación (simplificada, puedes agregar más reglas)
        $request->validate([
            'numero_orden' => 'required',
            'fecha_orden' => 'required|date',
            'beneficiario' => 'required',
            'concepto_gasto' => 'required',
            'monto_a_pagar' => 'required|numeric',
            'sector.*' => 'required',
            'monto.*' => 'required|numeric',
        ]);

        $ordenCompra = null;

        DB::transaction(function () use ($request, &$ordenCompra) {
            
            // 1. Crear la Orden de Pago principal
            $ordenCompra = OrdenCompra::create([
                'requerimiento_id' => $request->requerimiento_id,
                'numero_orden' => $request->numero_orden,
                'fecha_orden' => $request->fecha_orden,
                'rif' => $request->rif,
                'monto_bs' => $request->monto_bs,
                'cantidad_letras' => $request->cantidad_letras,
                'orden_compra_numero' => $request->orden_compra_numero,
                'tipo_orden' => $request->tipo_orden,
                'orden_servicio_numero' => $request->orden_servicio_numero,
                'beneficiario' => $request->beneficiario,
                'autorizado_cobrar' => $request->autorizado_cobrar,
                'concepto_gasto' => $request->concepto_gasto,
                'base_satet' => $request->base_satet,
                'retencion_satet' => $request->retencion_satet,
                'n_comprobante_retencion' => $request->n_comprobante_retencion,
                'n_transferencia' => $request->n_transferencia,
                'base_iva' => $request->base_iva,
                'total_iva' => $request->total_iva,
                'ret_iva' => $request->ret_iva,
                'monto_a_pagar' => $request->monto_a_pagar,
                'administrador_nombre' => $request->administrador_nombre,
                'presidente_nombre' => $request->presidente_nombre,
                'observaciones' => $request->observaciones,
            ]);

            // 2. Recorrer y guardar los detalles (las partidas)
            foreach ($request->sector as $index => $sector) {
                if (!empty($sector) && !empty($request->monto[$index])) {
                    $ordenCompra->detalles()->create([
                        'sector' => $sector,
                        'programa' => $request->programa[$index],
                        'actividad' => $request->actividad[$index],
                        'partida' => $request->partida[$index],
                        'generica' => $request->generica[$index],
                        'especifica' => $request->especifica[$index],
                        'subespecifica' => $request->subespecifica[$index],
                        'monto' => $request->monto[$index],
                    ]);
                }
            }
        });

        // 3. Redirigir a la nueva página de confirmación
        return redirect()->route('ordencompra.confirm', ['ordenCompra' => $ordenCompra->id])
                         ->with('success', 'Orden de Pago guardada exitosamente.');
    }

    /**
     * Muestra la página de confirmación.
     */
    public function confirm(OrdenCompra $ordenCompra)
    {
        return view('ordencompra.confirm', compact('ordenCompra'));
    }

    /**
     * Muestra la vista final (formato PDF) con botones de acción.
     */
    public function pdf(OrdenCompra $ordenCompra)
    {
        $ordenCompra->load('detalles'); // Carga los detalles de la orden
        return view('ordencompra.pdf', ['orden' => $ordenCompra]); // 'orden' para que coincida con tu vista
    }
}