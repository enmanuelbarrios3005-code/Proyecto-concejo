
@include('expedientes.estado.estado')
@include('expedientes.importar.importar')
@include('expedientes.ver.documentos')

<style>
    .modal-content {
        border-radius: 10px;
        transition: transform 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .modal-header {
        border-bottom: none;
        background-color: #26609e;
        color: white;
    }
    .modal-body {
        font-size: 1.1rem;
        padding: 20px;
    }
    .user-details p {
        margin: 10px 0;
    }
    .modal-footer {
        justify-content: space-between;
    }
    .modal-footer .btn {
        flex: 1;
        margin: 0 5px;
    }
    .modal.fade .modal-dialog {
        transform: translate(0, -25%);
    }
    .modal.show .modal-dialog {
        transform: translate(0, 0);
    }
</style>

<!-- Modal para mostrar detalles del usuario -->
<div class="modal fade" id="visualizarModal" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visualizarModalLabel">Detalles del expediente </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
    <div class="card shadow-sm mb-3" style="border-radius: 10px; border: 1px solid #007bff;">
    <img id="userImagen" alt="Imagen del usuario" class="card-img-top img-fluid rounded-circle" style="max-width: 150px;  margin: 20px auto;">

        <div class="card-body">
            
            <div class="user-details">
                <p class="border-bottom pb-2"><strong>Nombres:</strong> <span id="usuarioNombres">{{ isset($nombreUsuario) ? $nombreUsuario : 'No disponible' }}</span></p>
                <p class="border-bottom pb-2"><strong>Apellido:</strong> <span id="usuarioapellido">{{ isset($apellidoUsuario) ? $apellidoUsuario : 'No disponible' }}</span></p>
                <p class="border-bottom pb-2"><strong>Cédula:</strong> <span id="usuarioCedula">{{ isset($expediente->cedula) ? $expediente->cedula : 'No disponible' }}</span></p>
                <p class="border-bottom pb-2"><strong>Correo:</strong> <span id="usuarioCorreo">{{ isset($correoUsuario) ? $correoUsuario : 'No disponible' }}</span></p>
                <p class="border-bottom pb-2"><strong>Teléfono:</strong> <span id="usuarioTelefono">{{ isset($telefonoUsuario) ? $telefonoUsuario : 'No disponible' }}</span></p>
                <p class="border-bottom pb-2"><strong>Cargo:</strong> <span id="usuarioCargo">{{ isset($cargoUsuario) ? $cargoUsuario : 'No disponible' }}</span></p> <!-- New field for Cargo -->
                <p><strong>Estado:</strong> <span id="usuarioEstado">{{ isset($estadoUsuario) ? $estadoUsuario : 'No disponible' }}</span></p>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-body {
        background-color: #f8f9fa; /* Color de fondo claro */
    }
    .card {
        border: none; /* Sin borde en la tarjeta */
    }
    .card-title {
        font-size: 1.5rem; /* Tamaño de fuente más grande para el título */
        margin-bottom: 15px; /* Espacio inferior */
        color: #343a40; /* Color del texto del título */
    }
    .user-details p {
        margin: 3px 0; /* Espaciado entre los párrafos */
        font-size: 1.1rem; /* Tamaño de fuente */
        color: #495057; /* Color del texto */
        padding: 10px; /* Espaciado interno */
        border-radius: 20px; /* Bordes redondeados */
        border: 1px solid #007bff; /* Borde azul */
        background-color: #ffffff; /* Fondo blanco para los párrafos */
    }
    .user-details strong {
        color: #007bff; /* Color para las etiquetas */
    }
</style>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" id="btnModificar" onclick="modificarUsuario()">
        <i class="fa-solid fa-pencil-alt"></i> Modificar
    </button>
    <button type="button" class="btn btn-success" onclick="descargarExpediente()">
        <i class="fa-solid fa-download"></i> Descargar PDF
    </button>
    <button type="button" class="btn btn-primary" onclick="mostrarModalImportarDocumentos()">
        <i class="fa-solid fa-file-upload"></i> Añadir archivos
    </button>
    <button type="button" class="btn btn-info" id="btnVerDocumentos" onclick="mostrarModalDocumentos()">
        <i class="fa-solid fa-folder-open"></i> Ver Archivos
    </button>
    <button type="button" class="btn btn-warning" id="btnEstado" onclick="mostrarModalEstado()">
        <i class="fa-solid fa-user-check"></i> Ceses
    </button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class="fa-solid fa-xmark"></i> Volver
    </button>
</div>


        </div>
    </div>
</div>

<script>
 let expedienteId = null; // Declare the variable here for accessibility in all functions

function verDetalles(id, imagen, nombres, apellido, correo, telefono, documento, estado, cedula, cargo) {
    expedienteId = id;
    const imgElement = document.getElementById('userImagen');

    // Verifica si la imagen es válida, de lo contrario usa la ruta por defecto
    if (imagen && imagen.trim() !== '') {
        imgElement.src = imagen;
    } else {
        imgElement.src = '/images/por/defecto/a/imagen.jpg'; // Asegúrate de que esta ruta sea correcta
    }

    document.getElementById('usuarioNombres').innerText = nombres;
    document.getElementById('usuarioapellido').innerText = apellido;
    document.getElementById('usuarioCorreo').innerText = correo;
    document.getElementById('usuarioTelefono').innerText = telefono;
    document.getElementById('usuarioEstado').innerText = estado;
    document.getElementById('usuarioCedula').innerText = cedula; // Ensure this value is passed correctly
    document.getElementById('usuarioCargo').innerText = cargo; // Set the cargo value
    $('#visualizarModal').modal('show');
}

function verDocumento() {
    console.log("ID del expediente:", expedienteId);
    if (expedienteId) {
        const documentoUrl = `/documentos/${expedienteId}`;
        window.open(documentoUrl, '_blank');
    } else {
        alert("No se pudo encontrar el documento del expediente.");
    }
}

function modificarUsuario() {
    if (expedienteId) {
        window.location.href = '/expedientes/' + expedienteId + '/edit';
    } else {
        alert("No se pudo encontrar el ID del expediente.");
    }
}

function descargarExpediente() {
    if (expedienteId) {
        window.location.href = '/expedientes/' + expedienteId + '/download';
    } else {
        alert("No se pudo encontrar el ID del expediente para descargar.");
    }
}




function mostrarModalEstado() {
    $('#visualizarModal').modal('hide');
    const form = document.getElementById('editStatusForm');
    form.action = '/users/' + expedienteId + '/update-status';
    $('#estadoModal').modal('show');
}

function mostrarModalImportarDocumentos() {
    $('#visualizarModal').modal('hide');
    $('#importarDocumentosModal').modal('show');
}
</script>
















