
@extends('layouts.app')

@section('content')
@include('videos.sweetalert.alerta')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary font-weight-bold">Foro de Videos</h1>
        <a href="{{ route('videos.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-upload"></i> Subir Nuevo Video
        </a>
    </div>
    
    <div class="card mt-4">
        <div class="card-header">
            <h2>Videos Subidos</h2>
        </div>
        <div class="card-body">
            @if($videos->isEmpty())
                <p>No hay videos disponibles.</p>
            @else
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="embed-responsive embed-responsive-4by3">
                                    <video class="embed-responsive-item rounded-top" controls style="height: 200px;">
                                        <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                        Tu navegador no soporta la etiqueta de video.
                                    </video>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $video->title }}</h5>
                                    <p class="card-text text-muted">{{ $video->description }}</p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Publicado el {{ $video->created_at->format('d M Y') }}</small>
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="confirmDelete(event)">
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
    timer: 20000,
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
    width: '600px',
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