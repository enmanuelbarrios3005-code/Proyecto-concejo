<!-- Modal para importar documentos -->
<div class="modal fade" id="importarDocumentosModal" tabindex="-1" role="dialog" aria-labelledby="importarDocumentosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #26609e; color: white;">
                <h5 class="modal-title" id="importarDocumentosModalLabel">Importar Documentos</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            <div class="modal-body text-center">
                <form id="importarDocumentosForm" action="{{ route('documentos.importar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @foreach($expedientes as $expediente)
                    <input type="hidden" name="expediente_id" value="{{ $expediente->id }}">
                    @endforeach
                    <div class="form-group">
                        <label for="documentos">Selecciona los documentos a importar</label>
                        <input type="file" class="form-control-file" id="documentos" name="documentos[]" multiple required>
                        <small class="form-text text-muted">Puedes cargar varios archivos a la vez.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Importar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Volver</button>
                </form>  
            </div>
        </div>
    </div>
</div>
<script>
    function mostrarModalImportarDocumentos() {
        $('#importarDocumentosModal').modal('show'); // Mostrar el modal de importar documentos
    }
</script>
