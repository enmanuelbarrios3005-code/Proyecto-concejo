<div class="dataTables-container">
            <table id="ordenanzasTable" class="table table-hover table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N°</th>
                        <th>Gacetas</th>
                        <th>Fecha de aprobación</th>
                        <th>Categoría</th>
                        <th>ver</th>
                        <th>QR</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cetas as $ceta)
                    <tr>
                        <td>{{ $ceta->id }}</td>
                        <td>{{ $ceta->nombre }}</td>
                        <td>{{ $ceta->fecha_aprobacion }}</td>
                        <td>{{ $ceta->categoria }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ asset(Storage::url($ceta->ruta)) }}" class="btn btn-primary btn-action" target="_blank" title="Ver">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                 </td>
                                 <td>
                                <button type="button" class="btn btn-info btn-action" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $ceta->id }}" title="QR">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                </td>

                                <td>
                                <a href="{{ asset(Storage::url($ceta->ruta)) }}" class="btn btn-success btn-action" download="{{ $ceta->nombre }}" target="_blank" title="Descargar">
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