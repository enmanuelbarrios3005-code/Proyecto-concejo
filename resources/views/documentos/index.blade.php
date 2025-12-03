@extends('layouts.app')

@section('title', 'Filtrar Documentos')

@section('content')
<section class="filter-form py-5 animate__animated animate__fadeIn">
    <div class="container">
        <h2 class="text-center">Filtrar Documentos</h2>
        <form id="filterForm" method="POST" action="{{ route('documentos.filtrar') }}" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="document-type" class="form-label">Tipo de Documento</label>
                        <select id="document-type" name="document-type" class="form-select">
                            <option value="">Todos</option>
                            <option value="ordenanza">Ordenanza</option>
                            <option value="gaceta">Gaceta</option>
                            <option value="resolucion">Resolución</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="document-name" class="form-label">Nombre del Documento</label>
                        <input type="text" id="document-name" name="document-name" class="form-control" placeholder="Ingrese nombre del documento">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date-from" class="form-label">Desde</label>
                        <input type="date" id="date-from" name="date-from" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date-to" class="form-label">Hasta</label>
                        <input type="date" id="date-to" name="date-to" class="form-control">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
        
        <!-- Resultados de la filtración -->
        <div class="mt-4">
            <h3>Resultados</h3>
            <ul class="list-group">
                @foreach($documentos as $documento)
                    <li class="list-group-item">
                        <h5>{{ $documento->nombre }}</h5>
                        <p>Ruta: {{ $documento->ruta }}</p>
                        <small>{{ $documento->tipo }} - {{ $documento->fecha }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
