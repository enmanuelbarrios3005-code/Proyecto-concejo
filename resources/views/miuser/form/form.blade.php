

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title"><i class="fa-solid fa-image"></i> Imagen de Usuario</h5>
            </div>

            <div class="card-body box-profile text-center">
                @if($imagens->isNotEmpty())
                    <img class="profile-user-img img-fluid img-circle mb-3"
                         src="{{ $imagens->first()->url }}"
                         alt="User profile picture"
                         style="width: 200px; height: 200px;">
                @endif
                <h3 class="profile-username">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h3>
                <div class="alert alert-success mt-2" role="alert">
                    Nivel de usuario
                <p class="text-muted user-level">
             {{ auth()->user()->nivel_de_acceso }}</p>

            </div>
                <div class="alert alert-danger mt-2" role="alert">
                    Solo se permiten formatos de imagen (JPG, JPEG, PNG , BMP, GIF , SVG) Con un tamaño máximo de 2048 mb.
                </div>

                <br>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i> Importar Imagen
                </button>

                @include('miuser.modal.cargar_imagen')


                
            </div>
        </div>
    </div>

 