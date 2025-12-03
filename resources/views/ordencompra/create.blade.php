@extends('layouts.app')

@section('content')
<div class="container" style="max-width:900px;">
    <h1>Nueva Orden de Pago</h1>
    <p>Llene los datos de la orden. Los campos de requerimiento se autocompletarán si vienes de uno.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="ordenForm" action="{{ route('ordencompra.store') }}" method="POST">
        @csrf

        @isset($requerimiento)
            <input type="hidden" name="requerimiento_id" value="{{ $requerimiento->id }}">
        @endisset

        <div class="card shadow-sm mb-4">
            <div class="card-header">Encabezado</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">N° Orden Pago</label>
                        <input type="text" class="form-control" name="numero_orden" value="{{ old('numero_orden') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha_orden" value="{{ old('fecha_orden', date('Y-m-d')) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">R.I.F.</label>
                        <input type="text" class="form-control" name="rif" value="{{ old('rif', 'G-20007405-1') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Monto Bs.</label>
                        <input type="text" class="form-control" name="monto_bs" value="{{ old('monto_bs') }}" placeholder="(El de arriba)">
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">La cantidad de (en letras):</label>
                    <input type="text" class="form-control" name="cantidad_letras" value="{{ old('cantidad_letras') }}">
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header">Información del Gasto</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Orden de Compra N° (N° Req.)</label>
                        <input type="text" class="form-control" name="orden_compra_numero" 
                               value="{{ old('orden_compra_numero', $requerimiento->numero_requerimiento ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipo de Orden</label>
                        <input type="text" class="form-control" name="tipo_orden" value="{{ old('tipo_orden') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Orden de Servicio N°</label>
                        <input type="text" class="form-control" name="orden_servicio_numero" value="{{ old('orden_servicio_numero') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Beneficiario</label>
                        <input type="text" class="form-control" name="beneficiario" value="{{ old('beneficiario') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Autorizado a Cobrar</label>
                        <input type="text" class="form-control" name="autorizado_cobrar" value="{{ old('autorizado_cobrar') }}">
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Concepto del Gasto</label>
                    <textarea class="form-control" name="concepto_gasto" rows="2">{{ old('concepto_gasto', $requerimiento->detalles->first()->descripcion ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header">Detalle de Partidas</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="detalleOrdenTable" class="table table-bordered align-middle text-center" style="font-size: 0.8rem;">
                        <thead class="table-dark">
                            <tr>
                                <th>SECTOR</th>
                                <th>PROGRAMA</th>
                                <th>ACTIVIDAD</th>
                                <th>PARTIDA</th>
                                <th>GENÉRICA</th>
                                <th>ESPECÍFICA</th>
                                <th>SUB.ESP.</th>
                                <th>MONTO BS.</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="sector[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="programa[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="actividad[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="partida[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="generica[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="especifica[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="subespecifica[]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="monto[]" class="form-control form-control-sm"></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm removeRowBtn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success mb-2" id="addRowBtn">
                    <i class="fa fa-plus"></i> Agregar fila
                </button>
            </div>
        </div>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header">Totales y Firmas</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><label>Base SATET</label><input type="text" name="base_satet" class="form-control"></div>
                    <div class="col-md-3"><label>Retención SATET</label><input type="text" name="retencion_satet" class="form-control"></div>
                    <div class="col-md-3"><label>N° Comp. Retención</label><input type="text" name="n_comprobante_retencion" class="form-control"></div>
                    <div class="col-md-3"><label>N° Transferencia</label><input type="text" name="n_transferencia" class="form-control"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><label>Base I.V.A.</label><input type="text" name="base_iva" class="form-control"></div>
                    <div class="col-md-3"><label>Total I.V.A.</label><input type="text" name="total_iva" class="form-control"></div>
                    <div class="col-md-3"><label>Ret. I.V.A</label><input type="text" name="ret_iva" class="form-control"></div>
                    <div class="col-md-3"><label class="fw-bold">Monto a Pagar</label><input type="text" name="monto_a_pagar" class="form-control fw-bold"></div>
                </div>
                 <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>Administrador</label>
                        <input type="text" name="administrador_nombre" class="form-control" value="LCDO. GUIDO PEREZ">
                    </div>
                    <div class="col-md-6">
                        <label>Presidente</label>
                        <input type="text" name="presidente_nombre" class="form-control" value="LCDO. MANUEL MARQUEZ">
                    </div>
                </div>
                <div class="mt-3">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg">Guardar Orden de Pago</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#addRowBtn').on('click', function() {
        let row = `<tr>
            <td><input type="text" name="sector[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="programa[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="actividad[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="partida[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="generica[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="especifica[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="subespecifica[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="monto[]" class="form-control form-control-sm"></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeRowBtn">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`;
        $('#detalleOrdenTable tbody').append(row);
    });

    $('#detalleOrdenTable').on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endpush