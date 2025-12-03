<div class="dataTables-container">
            <table id="ordenanzasTable" class="table table-hover table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N°</th>
                        <th>Acuerdos</th>
                        <th>Fecha de aprobación</th>
                        <th>Categoria</th>
                        <th>ver</th>
                        <th>QR</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acue as $acue)
                    <tr>
                        <td>{{ $acue->id }}</td>
                        <td>{{ $acue->nombre }}</td>
                        <td>{{ $acue->fecha_aprobacion }}</td>
                        <td>{{ $acue->categoria }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ asset(Storage::url($acue->ruta)) }}" class="btn btn-primary btn-action" target="_blank" title="Ver">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                 </td>
                                 <td>
                                <button type="button" class="btn btn-info btn-action" data-bs-toggle="modal" data-bs-target="#qrModal-{{ $acue->id }}" title="QR">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>
                                </td>

                                <td>
                                <a href="{{ asset(Storage::url($acue->ruta)) }}" class="btn btn-success btn-action" download="{{ $acue->nombre }}" target="_blank" title="Descargar">
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