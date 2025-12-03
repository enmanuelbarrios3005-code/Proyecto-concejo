
@extends('layouts.app')
@section('title', 'Expedientes')
@section('container')
    <!-- ./datatable -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">       
    <!-- Asegúrate de haber incluido Font Awesome en tu proyecto -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('instrumentoslegales.sweetalert.alerta')
    <!-- pántalla MODAL ----------------------------- -->
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-upload"></i>
         Crear Nuevo Expediente
        </button>           
    </div>
    @include('expedientes.importar.importar')
    @include('expedientes.estado.estado')
    @include('expedientes.visualizar.modal')
    @include('expedientes.modal.modal') <!-- Cambiado a expedientes -->
    @include('expedientes.datatable.datatable') <!-- Cambiado a expedientes -->
    <!-- script ----------------------------- -->
  
    <script src="{{ asset('Datatable/data_table.js') }}"></script>



    <script>
        $(document).ready(function() {
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    width: '600px',
                    heightAuto: false
                });
            @endif
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'Ok',
                    width: '600px',
                    heightAuto: false
                });
            @endif 
        });
    </script>
    <script>
    document.addEventListener('submit', function(event) {
        if (event.target && event.target.id === 'uploadForm') {
            const fileInput = document.getElementById('expediente'); // Cambiado a expediente
            
            // Verifica si hay un archivo seleccionado
            if (fileInput.files.length === 0) {
                event.preventDefault(); // Evita el envío del formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, selecciona un archivo.',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    width: '600px',
                    heightAuto: false
                });
                return;
            }
            
            const file = fileInput.files[0];
            
            // Verifica si el archivo es un PDF
            if (file.type !== 'application/pdf') {
                event.preventDefault(); // Evita el envío del formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El archivo seleccionado no es un documento PDF.',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    width: '600px',
                    heightAuto: false
                });
            }
        }
    });
</script>
    
    <script>
        function printPDF(pdfUrl) {
            const win = window.open(pdfUrl, '_blank'); // Abre el PDF en una nueva ventana
            // Espera a que la ventana se cargue
            win.onload = function() {
                setTimeout(function() {
                    win.print(); // Abre el cuadro de diálogo de impresión
                    // win.close(); // Descomentar si deseas cerrar la ventana después de imprimir
                }, 1000); // Ajusta el tiempo si es necesario
            };
        }
    </script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Cambios confirmados!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif



@endsection
