@extends('layouts.app')

@section('content')
<div class="container text-center" style="max-width: 600px;">
    <div class="card shadow-sm mt-5">
        <div class="card-body p-5">
            <h1 class="h3 mb-3 fw-normal">¡Éxito!</h1>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <p class="lead">
                El requerimiento <strong>N° {{ $requerimiento->numero_requerimiento }}</strong> se ha guardado correctamente.
            </p>
            <p>
                Ahora puedes generar el documento final para imprimirlo o descargarlo en PDF.
            </p>
          
            <a href="{{ route('ordencompra.createFromRequerimiento', $requerimiento) }}" class="btn btn-primary btn-lg mt-3">
                <i class="fa fa-file-invoice-dollar"></i> Generar Orden de Compra
            </a>

            <a href="{{ route('requerimientos.pdf', $requerimiento) }}" class="btn btn-primary btn-lg mt-3" target="_blank">
                <i class="fa fa-file-pdf"></i> Ver PDF / Imprimir
            </a>

            <a href="{{ route('requerimientos.create') }}" class="btn btn-secondary mt-3">
                Crear nuevo requerimiento
            </a>
        </div>
    </div>
</div>
@endsection