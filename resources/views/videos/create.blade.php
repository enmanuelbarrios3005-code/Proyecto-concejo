@extends('layouts.app')

@section('content')
@include('instrumentoslegales.sweetalert.alerta')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary font-weight-bold">Galería de Videos</h1>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h2>Subir Video</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="video">Video:</label>
                    <input type="file" id="video" name="video" class="form-control-file @error('video') is-invalid @enderror" required>
                    @error('video')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Subir Video</button>
            </form>
        </div>
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

function validateForm() {
    let title = document.getElementById('title').value;
    let description = document.getElementById('description').value;
    let video = document.getElementById('video').files[0];

    if (!title || !description || !video) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Todos los campos son obligatorios.',
            showConfirmButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ok',
            width: '400px',
            heightAuto: false
        });
        return false;
    }

    let mimeType = video.type;
    if (!['video/mp4', 'video/avi', 'video/mov'].includes(mimeType)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El archivo subido no es un video válido. Solo se permiten archivos MP4, AVI y MOV.',
            showConfirmButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ok',
            width: '400px',
            heightAuto: false
        });
        return false;
    }

    return true;
}
</script>

blade
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

@endsection
