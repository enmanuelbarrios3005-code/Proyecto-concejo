<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Imagen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
           <form id="upload-form" action="{{ route('miuser.store') }}" method="POST">
    @csrf
    <div id="my-dropzone" class="dropzone"></div>
</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#my-dropzone", {
        url: "{{ route('miuser.store') }}",
        maxFilesize: 256, // Tamaño máximo del archivo en MB
        acceptedFiles: ".jpg,.jpeg,.png,.bmp,.gif,.svg,.webp", // Tipos de archivos permitidos
        addRemoveLinks: false, // No mostrar enlaces para eliminar archivos
        dictDefaultMessage: "Arrastra los archivos aquí para subirlos, o haz clic para seleccionar una imagen",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        paramName: "file", // Asegúrate de que el nombre del campo coincide con el esperado en el servidor
        init: function() {
            this.on("addedfile", function(file) {
                // Botón de eliminación personalizado
                let removeButton = Dropzone.createElement("<div class='text-center mt-2'><button class='btn btn-danger btn-sm'>Eliminar</button></div>");

                // Agregar evento para eliminar archivo al hacer clic
                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Eliminar archivo desde Dropzone
                    dropzone.removeFile(file);
                });

                // Añadir el botón al archivo cargado
                file.previewElement.appendChild(removeButton);

                // Remover cualquier archivo previamente cargado
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });

            // Evento al completar la carga con éxito
            this.on("success", function(file, response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.success,
                      timer: 20000,
                     timerProgressBar: true,
                    confirmButtonColor: '#6E0EE9',
                    confirmButtonText: 'Ok',
                    width: '600px',
                    heightAuto: false
                }).then(() => {
                    // Cerrar el modal
                    $('#exampleModal').modal('hide');
                    // Recargar la página para mostrar la nueva imagen
                    location.reload();
                });
            });

            // Evento al ocurrir un error en la carga
            this.on("error", function(file, response) {
                let errorMessage = '';

                // Si el error es por el tamaño del archivo
                if (file.size > this.options.maxFilesize * 1024 * 1024) {
                    errorMessage = 'Solo se permiten archivos JPG, JPEG, PNG, BMP, GIF, SVG. El tamaño máximo del archivo es de 2 MB.';
                } else if (response.errors) {
                    // Si hay errores de validación
                    for (let key in response.errors) {
                        errorMessage += response.errors[key] + '\n';
                    }
                } else if (typeof response === "string") {
                    // Mensaje de error desde el servidor
                    errorMessage = response;
                } else if (response.message) {
                    errorMessage = response.message;
                } else {
                    errorMessage = 'Ocurrió un error al subir la imagen.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                       timer: 20000,
                     timerProgressBar: true,
                    text: errorMessage,
                    confirmButtonText: 'Aceptar',
                    width: '600px',
                    heightAuto: false
                });

                // Asegúrate de que el botón de eliminación esté visible incluso con el mensaje de error
                file.previewElement.querySelector('.dz-error-message').style.display = 'none';
                file.previewElement.querySelector('.dz-error-message').innerHTML = errorMessage;
            });
        }
    });
</script>
