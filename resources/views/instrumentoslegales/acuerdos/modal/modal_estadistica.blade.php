<!-- Modal -->
<div class="modal fade" id="estadisticaModal" tabindex="-1" aria-labelledby="estadisticaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom-size">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="estadisticaModalLabel">
                    <i class="fa-solid fa-chart-pie"></i> Estadísticas de Acuerdos
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">            
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                @include('instrumentoslegales.acuerdos.estadisticas.Bar_Chart')                          
                </section>
            </div>
            <div class="modal-footer">
                <div class="form-group">                           
                    <label for="fecha_aprobacion">Seleccione la fecha que desea buscar:</label>
                    <input type="date" class="form-control" id="yearInput" name="fecha_aprobacion" required>
                <br>
            </div>   
               <button id="generateChart" class="btn btn-primary">Generar Gráfico</button>        
                <button id="downloadPDF" class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> Descargar PDF</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <i class="fa-solid fa-x"></i> Cerrar</button>             
            </div>
        </div>
    </div>
</div>
<style>
    .modal-custom-size {
        max-width: 80% !important; 
        width: 80% !important;
    }    
</style>
