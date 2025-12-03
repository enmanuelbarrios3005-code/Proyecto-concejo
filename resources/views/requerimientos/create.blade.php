@extends('layouts.app') 

@section('content')
<div class="container" style="max-width:900px;">
    <h1>Nuevo Requerimiento</h1>
    <p>Llene los datos basados en el formato de requerimiento.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="requerimientoForm" action="{{ route('requerimientos.store') }}" method="POST">
        @csrf

        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Encabezado del Requerimiento
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Requerimiento N°</label>
                        <input type="text" class="form-control" name="numero_requerimiento" placeholder="Ej: 002/2025" value="{{ old('numero_requerimiento') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Oficina</label>
                        <input type="text" class="form-control" name="oficina" placeholder="Ej: Secretaria de la Cámara Municipal" value="{{ old('oficina') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Detalles del Requerimiento
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="detalleRequerimientoTable" class="table table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 10%;">CANT.</th>
                                <th style="width: 50%;">Descripción</th>
                                <th style="width: 35%;">Observaciones</th>
                                <th style="width: 5%;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" name="cantidad[]" class="form-control" min="1"></td>
                                <td><textarea name="descripcion[]" class="form-control" rows="2"></textarea></td>
                                <td><textarea name="observaciones[]" class="form-control" rows="2"></textarea></td>
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
            <div class="card-header">
                Firmas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Elaborado por:</h5>
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control mb-2" name="elaborado_por_nombre" placeholder="Ej: María G. Salas" value="{{ old('elaborado_por_nombre') }}">
                        <label class="form-label">Cargo</label>
                        <input type="text" class="form-control" name="elaborado_por_cargo" placeholder="Ej: Secretaria Ejec. de la Cámara" value="{{ old('elaborado_por_cargo') }}">
                    </div>
                    <div class="col-md-6">
                        <h5>Recibido por:</h5>
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control mb-2" name="recibido_por_nombre" placeholder="Ej: Yemi Bastidas" value="{{ old('recibido_por_nombre') }}">
                        <label class="form-label">Cargo</label>
                        <input type="text" class="form-control" name="recibido_por_cargo" placeholder="Ej: Asistente Administrativa de la Cámara" value="{{ old('recibido_por_cargo') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Guardar Requerimiento</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script>
$(document).ready(function() {
    $('#addRowBtn').on('click', function() {
     
        let row = `<tr>
            <td><input type="number" name="cantidad[]" class="form-control" min="1"></td>
            <td><textarea name="descripcion[]" class="form-control" rows="2"></textarea></td>
            <td><textarea name="observaciones[]" class="form-control" rows="2"></textarea></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeRowBtn">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`;
        $('#detalleRequerimientoTable tbody').append(row);
    });

    // Evento para eliminar la fila (usa delegación de eventos)
    $('#detalleRequerimientoTable').on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    });
});
</script>
@endpush