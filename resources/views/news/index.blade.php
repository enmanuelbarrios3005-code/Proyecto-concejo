
@extends('layouts.app')

@section('content')
@include('instrumentoslegales.sweetalert.alerta')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary font-weight-bold">Foro de Noticias</h1>
        <a href="{{ route('news.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i> Crear Nueva Noticia
        </a>
    </div>
    
    <div class="card mt-4">
        <div class="card-header">
            <h2>Noticias Subidas</h2>
        </div>
        <div class="card-body">
            @if($news->isEmpty())
                <p>No hay noticias disponibles.</p>
            @else
                <div class="row">
                    @foreach ($news as $new)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="{{ asset('storage/' . $new->image) }}" class="card-img-top" alt="{{ $new->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $new->title }}</h5>
                                    <p class="card-text text-muted">{{ $new->description }}</p>
                                    @if ($new->video)
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video class="embed-responsive-item" width="100%" controls>
                                                <source src="{{ asset('storage/' . $new->video) }}" type="video/mp4">
                                                Tu navegador no soporta la etiqueta de video.
                                            </video>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <form action="{{ route('news.destroy', $new->id) }}" method="POST" onsubmit="confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@if(Session::has('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Éxito',
    text: '{{ Session::get('success') }}',
    showConfirmButton: true,
    timer: 5000,
    timerProgressBar: true,
    confirmButtonColor: '#6E0EE9',
    confirmButtonText: 'Ok',
    customClass: {
        popup: 'larger-alert'
    },
    width: '400px',
    heightAuto: false
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ $errors->first() }}',
    showConfirmButton: true,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Ok',
    width: '400px',
    heightAuto: false
});
</script>
@endif

<script>
function confirmDelete(event) {
    event.preventDefault(); // Prevenir el envío del formulario
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, ¡elimínalo!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit(); // Enviar el formulario si se confirma
        }
    });
}
</script>
@endsection