



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('success'))


<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ Session::get('img') }}',
        showConfirmButton: true,
        timer: 2000,
        timerProgressBar: true,
        confirmButtonColor: '#6E0EE9',
        confirmButtonText: 'Ok',
        customClass: {
            popup: 'larger-alert'
        },
        width: '600px',
        heightAuto: false
    });
</script>

<script>
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
        timer: 20000,
        timerProgressBar: true,
        confirmButtonText: 'Aceptar',
        width: '600px' // Ajusta el valor según el ancho deseado
    });
@endif
@if ($errors->any())
<script>
    let errorMessage = '';
    @foreach ($errors->all() as $error)
        errorMessage += '{{ $error }}\n';
    @endforeach
    Swal.fire({
        icon: 'error',
        timer: 20000,
        timerProgressBar: true,
        title: 'Error',
        text: errorMessage,
        confirmButtonText: 'Aceptar',
        width: '600px' // Ajusta el valor según el ancho deseado
    });
@endif
</script>
