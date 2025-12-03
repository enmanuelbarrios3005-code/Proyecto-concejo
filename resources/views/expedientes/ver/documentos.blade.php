<!-- Modal para mostrar documentos -->
<div class="modal fade" id="documentosModal" tabindex="-1" role="dialog" aria-labelledby="documentosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #26609e; color: white;">
                <h5 class="modal-title" id="documentosModalLabel">Documentos del Expediente</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Nombre del Documento</th>
                            <th>Fecha de Importación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="documentosLista">
                        <!-- Los documentos se cargarán dinámicamente aquí -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>
<script>
function mostrarModalDocumentos() {
    $('#visualizarModal').modal('hide'); // Ocultar el modal de detalles
    cargarDocumentos(expedienteId); // Cargar documentos del expediente
    $('#documentosModal').modal('show'); // Mostrar el modal de documentos
}

// Función para cargar los documentos del expediente
function cargarDocumentos(expedienteId) {
    console.log("Cargando documentos para el expediente ID:", expedienteId); // Verifica el ID en la consola
    fetch('/expedientes/' + expedienteId + '/documentos')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Verifica la respuesta en la consola
            $('#documentosLista').empty(); // Limpiar la tabla
            // Verifica si hay documentos en la respuesta
            if (data.length === 0) {
                $('#documentosLista').append('<tr><td colspan="3">No se encontraron documentos.</td></tr>');
                return;
            }
            // Agregar los documentos a la tabla
            data.forEach(function(documento) {
                $('#documentosLista').append(
                    '<tr>' +
                        '<td>' + documento.nombre + '</td>' +
                        '<td>' + new Date(documento.created_at).toLocaleString() + '</td>' +
                        '<td>' +
                            '<a href="' + documento.ruta + '" class="btn btn-success btn-sm" target="_blank" download>Descargar</a>' +
                        '</td>' +
                    '</tr>'
                );
            });
        })
        .catch(error => {
            console.error('Error al cargar los documentos:', error);
            alert('Error al cargar los documentos: ' + error.message);
        });
}

// Mostrar el modal y cargar documentos cuando se abra
$('#documentosModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que abrió el modal (si lo hay)
    var expedienteId = button.data('id'); // Extraer el ID del expediente de los atributos de datos
    cargarDocumentos(expedienteId); // Cargar documentos
});
</script>