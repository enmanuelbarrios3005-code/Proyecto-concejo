<div class="dataTables-container">
            <table id="ordenanzasTable" class="table table-hover table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N°</th>
                        <th>Ordenanza</th>
                        <th>Fecha de aprobación</th>
                        <th>Categoria</th>
                        <th>ver</th>
                        <th>QR</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordenanzas as $ordenanza)
                    <tr>
                        <td>{{ $ordenanza->id }}</td>
                        <td>{{ $ordenanza->nombre }}</td>
                        <td>{{ $ordenanza->fecha_aprobacion }}</td>
                        <td>{{ $ordenanza->categoria }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ asset(Storage::url($ordenanza->ruta)) }}" class="btn btn-primary btn-action" target="_blank" title="Ver">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                 </td>
                                 <td>
                                <button type="button" class="btn btn-info btn-action" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $ordenanza->id }}" title="QR">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                </td>

                                <td>
                                <a href="{{ route('ordenanzas.download', basename($ordenanza->ruta)) }}" class="btn btn-success btn-action" title="Descargar">
                                <i class="fa-solid fa-download"></i>
                               </a> 

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 