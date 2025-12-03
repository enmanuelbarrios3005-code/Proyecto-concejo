<!-- Modal para importar documentos -->
<div class="modal fade" id="estadoModal" tabindex="-1" role="dialog" aria-labelledby="estadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #26609e; color: white;">
                <h5 class="modal-title" id="estadoModalLabel">Detalles del Usuario</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form id="editStatusForm" action="" method="POST">
                    @csrf
                    @method('PATCH') <!-- Cambiado a PATCH -->
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del Retiro</label>
                        <textarea class="form-control" id="motivo" name="motivo" rows="4" placeholder="Describa el motivo del retiro del usuario"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_egreso">Fecha de Egreso</label>
                        <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Volver</button>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function mostrarModalEstado(userId) {
    const form = document.getElementById('editStatusForm');
    form.action = '/users/' + userId + '/update-status'; // Ajusta la ruta según tu configuración
    $('#estadoModal').modal('show'); // Mostrar el modal de estado
}

// Interceptar el envío del formulario para mostrar la alerta de confirmación
document.getElementById('editStatusForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Estos cambios no se podrán revertir.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, guardar cambios',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); // Enviar el formulario si se confirma
        }
    });
});
</script>
