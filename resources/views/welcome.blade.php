<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Concejo Municipal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> 
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
       
    /* Ajustar el tamaño de la sección */
    .events-section {
        padding-top: 1rem;  /* Reduce el padding superior */
        padding-bottom: 1rem;  /* Reduce el padding inferior */
    }
    /* Ajustar el tamaño de la imagen */
    .events-section img {
        max-height: 400px;  /* Establece una altura máxima para la imagen */
        object-fit: cover;  /* Asegura que la imagen se recorte si es necesario para ajustarse */
        width: 100%;  /* Asegura que la imagen ocupe todo el ancho del contenedor */
    }
    .main-header {
        background: -webkit-linear-gradient(to right,  #125496,  #125496, #125496, #1160af);
  
  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: linear-gradient(to right, #11467a,   #0f62b4,   #0c65be,   #0b62b9);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

   .scroll-to-top {
    position: fixed;
    bottom: 110px;
    right: 35px;
    display: none;
    background: #333;
    color: white;
    padding: 15px; /* Aumenta el padding para hacer el botón más grande */
    border-radius: 0; /* Cambia a 0 para hacer el botón cuadrado */
    text-align: center;
    cursor: pointer;
    font-size: 18px; /* Ajusta el tamaño de la fuente */
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); /* Añade una sombra para darle profundidad */
    transition: background 0.3s; /* Añade una transición suave al fondo */
}
.scroll-to-top:hover {
    background: #555; /* Cambia el color de fondo al pasar el mouse */
}
      
      .map-container iframe {
    width: 100%; /* Ajusta el iframe al ancho del contenedor */
    height: 300px; /* Altura adaptable */
    max-width: 100%; /* Evita el desbordamiento en móviles */
}

@media (min-width: 768px) {
    .map-container iframe {
        height: 450px; /* Altura mayor para pantallas más grandes */
    }
}

@media (min-width: 1200px) {
    .map-container iframe {
        height: 600px; /* Altura completa en pantallas grandes */
    }
}

      
    </style>
  
  
  
   <style>
        #map { height: 500px; }
    </style>
  
    
</head>
<body>
    <section class="intro-section py-3 animate__animated"></section>
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container">  
            <a class="navbar-brand" href="/login">
                <img src="{{ asset('img/logo.png') }}" alt="Camara Municipal de Escuque" style="height: 80px; margin-right: 20px;" />
            </a>                  
          
          
          
          
          
          
          
          
          
          
          
          
    <script src="https://cdn.botpress.cloud/webchat/v2.2/inject.js"></script>
<script src="https://files.bpcontent.cloud/2025/03/20/02/20250320022815-FB888C29.js"></script>
    
          

          
        
          
          <!-- Cambia el icono si lo deseas -->
            <div class="scroll-to-top">
    <i class="fa-solid fa-arrow-up"></i> 
              
              
              
              
              
</div>  

<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle">
    <i class="fa-solid fa-book-open-reader"></i> Instrumentos Legales
  </button>
  <div class="dropdown-content">
    <a href="{{ url('/legales') }}"><i class="fa-solid fa-book-journal-whills"></i> Ordenanzas</a>
    <a href="{{ url('/cetas') }}"><i class="fa-solid fa-book-journal-whills"></i>  Gacetas</a>
    <a href="{{ url('/resol') }}"><i class="fa-solid fa-book-journal-whills"></i>  Resoluciones</a>
    <a href="{{ url('/acue') }}"><i class="fa-solid fa-book-journal-whills"></i>  Acuerdos</a>
  </div>
   <!--
   </div> 
           <button type="button" class="btn btn-warning" 
        data-toggle="modal" 
        data-target="#buzonSugerenciasModal"> 
    Abrir Buzón de Sugerencias
</button>

<div class="modal fade" id="buzonSugerenciasModal" tabindex="-1" role="dialog" aria-labelledby="buzonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buzonModalLabel">Buzón de Sugerencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSugerencia">
                    @csrf
                    
                    <div class="form-group">
                        <label for="mensaje">Tu Sugerencia:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        <div class="invalid-feedback" id="mensaje-error"></div>
                    </div>

                    <div id="resultado-envio" class="mt-3"></div>

                    <button type="submit" class="btn btn-success" id="btnEnviarSugerencia">Enviar Sugerencia</button>
                </form>
            </div>
        </div>
    </div>
</div> --> 

<script>
    // 1. Define la URL de la ruta de Laravel para AJAX
    const SUGERENCIA_URL = '{{ route("sugerencias.enviar") }}';

    $(document).ready(function() {
        $('#formSugerencia').on('submit', function(e) {
            e.preventDefault(); 

            // Limpiar mensajes y estilos previos
            $('#resultado-envio').empty().removeClass('alert alert-success alert-danger');
            $('.invalid-feedback').text('').hide();
            $('.form-control').removeClass('is-invalid');
            $('#btnEnviarSugerencia').prop('disabled', true).text('Enviando...'); // Deshabilitar botón

            $.ajax({
                url: SUGERENCIA_URL,
                method: 'POST',
                data: $(this).serialize(), // Datos del formulario
                dataType: 'json',
                success: function(response) {
                    // Éxito:
                    $('#resultado-envio').addClass('alert alert-success').text(response.success);
                    $('#formSugerencia')[0].reset(); // Limpia el formulario
                    $('#btnEnviarSugerencia').prop('disabled', false).text('Enviar Sugerencia');
                    
                    // Opcional: Cerrar el modal después de 3 segundos
                    setTimeout(function() {
                        $('#buzonSugerenciasModal').modal('hide');
                    }, 3000);
                },
                error: function(response) {
                    $('#btnEnviarSugerencia').prop('disabled', false).text('Enviar Sugerencia');

                    if (response.status === 422) {
                        // Error de validación (Laravel)
                        var errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error').text(value).show();
                            $('#' + key).addClass('is-invalid');
                        });
                        $('#resultado-envio').addClass('alert alert-danger').text('Error de validación. Revisa los campos.');
                    } else {
                        // Otros errores (servidor 500, etc.)
                        $('#resultado-envio').addClass('alert alert-danger').text('Hubo un error en el servidor. Intenta de nuevo.');
                    }
                }
            });
        });
    });
</script>
        </div>

    @yield('content')
    <!-- ... -->
        </div>
    </nav>
    
    <header class="main-header text-center animate__animated">     
        <h3>Bienvenidos al Concejo Municipal de Escuque</h3>
    </header>
    
    <section class="events-section py-2 animate__animated" style="background-color:rgb(189, 203, 216);">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
      <img src="{{ asset('img/plaza2.jpeg') }}" alt="Descripción de la imagen" class="d-block w-100" />
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/consejo.jpeg') }}" alt="Descripción de la imagen" class="d-block w-100" />
      </div>
         
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
</section>

    
    <section class="intro-section py-3 animate__animated"></section>
    
<section class="description py-5 animate__animated animate__fadeIn" style="background-color: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-4" style="font-weight: bold; color: #343a40;">Sobre Nosotros</h2>
                <p class="lead mb-4" style="color: #6c757d; text-align: justify;">
                    El Concejo Municipal de Escuque se dedica a servir a la comunidad con responsabilidad y transparencia. Conozca más sobre nuestros proyectos y actividades.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Misión</h5>
                        <p class="card-text" style="text-align: justify;">Legislar, Aprobar las Ordenanzas del Municipio Escuque, autorizar modificaciones presupuestarias, ejercer funciones de control político, seguimiento y evaluación de los órganos de la administración pública municipal, estableciendo los principios generales para el ejercicio de la función legislativa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Visión</h5>
                        <p class="card-text" style="text-align: justify;">Lograr establecer todas las bases y principios generales en el ejercicio de la función legislativa, en cuanto a velar y garantizar el cumplimiento de las políticas públicas a través de la democracia participativa de las diferentes comunidades organizadas del municipio Escuque, así como cumplir con la Normativa que rige la materia de este órgano establecido en la Constitución, con la Ley Orgánica del Poder Público Municipal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Objetivo</h5>
                        <p class="card-text" style="text-align: justify;">El Órgano Legislativo del Municipio Escuque tiene como objetivo principal dentro de sus funciones es Legislar en la materia de sus competencias y ejercer el control de la gestión política de la rama Ejecutiva Municipal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-people-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Funciones</h5>
                        <p class="card-text" style="text-align: justify;">Sus funciones son fiscalizar la gestión municipal, deliberar y elaborar leyes, ordenanzas municipales y otros documentos normativos destinados a mejorar la calidad de vida de los habitantes de nuestro municipio.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-people-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Participación Ciudadana</h5>
                        <p class="card-text" style="text-align: justify;">Facilitamos la participación ciudadana en la toma de decisiones a través de nuestra plataforma.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box">
                            <i class="bi bi-file-earmark-text-fill" style="font-size: 2rem; color: #007bff;"></i>
                        </div>
                        <h5 class="card-title mt-3">Acceso a Documentos</h5>
                        <p class="card-text" style="text-align: justify;">Los ciudadanos podrán consultar y descargar ordenanzas y otros documentos legales de manera rápida y sencilla.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="intro-section py-3 animate__animated"></section>
   
    <section class="events-section py-2 animate__animated" style="background-color:rgb(189, 203, 216);">
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('img/plaza2.jpeg') }}" alt="Descripción de la imagen" class="img-fluid" style="width: 100%; height: auto;" />
        </div>
    </div>
</section>



    <section class="intro-section py-3 animate__animated"></section>

  <section class="events-section py-5 animate__animated" style="background-color:rgb(238, 241, 243);">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; font-size: 2.5em; color: #343a40; text-transform: uppercase;">Noticias Destacadas</h2>
        <div id="carouselNoticias" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                @foreach ($news as $new)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            <div class="col-md-5 mx-2">
                                <div class="card" style="border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 10px;">
                                    <img src="{{ asset('storage/' . $new->image) }}" alt="{{ $new->title }}" class="card-img-top" style="width: 100%; height: 300px; object-fit: contain; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <div class="card-body" style="background-color: #fff; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                        <h5 class="card-title" style="font-family: 'Playfair Display', serif; color: #343a40; text-align: justify;">{{ $new->title }}</h5>
                                        <p class="card-text" style="color: #6c757d; text-align: justify;">{{ $new->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselNoticias" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 5px;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselNoticias" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 5px;"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>   

<section class="intro-section py-3 animate__animated"></section>

<header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6"></div>
            </div>
        </div>
    </header>

    <section class="intro-section py-3 animate__animated"></section>

    <section class="events-section py-5 animate__animated" style="background-color:rgb(238, 241, 243);">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; font-size: 2.5em; color: #343a40; text-transform: uppercase;">Eventos Destacados</h2>
        <div id="carouselVideos" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                @if($videos->isEmpty())
                   
                @else
                    @foreach ($videos->chunk(2) as $videoChunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($videoChunk as $video)
                                    <div class="col-md-5 mx-2">
                                        <div class="card" style="border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 10px;">
                                            <video class="card-img-top" controls style="border-top-left-radius: 10px; border-top-right-radius: 10px; width: 100%; height: 300px; object-fit: cover;">
                                                <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                                Tu navegador no soporta la etiqueta de video.
                                            </video>
                                            <div class="card-body" style="background-color: #fff; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                                <h5 class="card-title" style="font-family: 'Playfair Display', serif; color: #343a40;">{{ $video->title }}</h5>
                                                <p class="card-text" style="color: #6c757d;">{{ $video->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselVideos" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 5px;"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselVideos" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 5px;"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>


    
<section class="map-section py-5 animate__animated">
    <div class="container">
        <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif; font-size: 2.5em; color: #343a40; text-transform: uppercase;">Localidad</h2>
        <div class="map-container">
            <iframe  
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27069.77772218588!2d-70.70905888916012!3d9.29580500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e6326f6875caf13%3A0x3b483da5b1819030!2sAlcald%C3%ADa%20del%20Municipio%20Escuque!5e1!3m2!1ses-419!2sve!4v1742436418341!5m2!1ses-419!2sve"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>



    <section class="events-section py-2 animate__animated" style="background-color:rgb(189, 203, 216);">
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('img/iglesia3.jpg') }}" alt="Descripción de la imagen" class="img-fluid" style="width: 100%; height: auto;" />
        </div>
    </div>
</section>
<section class="intro-section py-3 animate__animated"></section>
    <footer class="footer bg-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item">⋅</li>
                        <a href="{{ url('/nosotros') }}">Sobre Nosotros</a>
                        <li class="list-inline-item">⋅</li>
                        
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; Camara Municipal de Escuque 2025. Todos los Derechos Reservados.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-4"><a href="https://www.facebook.com/p/camaramunicipalescuque-100080173747094/?locale=es_LA"><i class="bi-facebook fs-3"></i></a></li>
                        
                        <li class="list-inline-item"><a href="https://www.instagram.com/alcaldiadeescuque/?hl=es"><i class="bi-instagram fs-3"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
      
     
    </footer>
  
  
      <section class="intro-section py-3 animate__animated"></section>
  
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Definir la variable videos usando let
    let videos = [
     
        // Añade más videos aquí
    ];

    let videoContainer = document.getElementById('featured-videos');
    if (videoContainer) {
        // Vaciar el contenedor antes de insertar los nuevos videos
        videoContainer.innerHTML = '';

        // Mostrar todos los videos de la lista
        videos.forEach(video => {
            let videoElement = `
                <div class="col-12 text-center">
                    <div class="video-item">
                        <h3>${video.title}</h3>
                        <video width="100%" controls>
                            <source src="${video.url}" type="video/mp4">
                            Tu navegador no soporta la etiqueta de video.
                        </video>
                    </div>
                </div>
            `;
            videoContainer.insertAdjacentHTML('beforeend', videoElement);
        });
    } else {
        console.error('El contenedor de videos no existe.');
    }
});
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cargar Noticias
            fetch('/api/news')
                .then(response => response.json())
                .then(data => {
                    const eventsContainer = document.getElementById('events');
                    data.forEach(news => {
                        const newsCard = document.createElement('div');
                        newsCard.classList.add('col-md-4', 'mb-4');
                        newsCard.innerHTML = `
                            <div class="card h-100 shadow-sm">
                                <img src="/storage/${news.image}" class="card-img-top" alt="${news.title}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">${news.title}</h5>
                                    <p class="card-text text-muted">${news.description}</p>
                                    ${news.video ? `
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video class="embed-responsive-item" controls>
                                                <source src="/storage/${news.video}" type="video/mp4">
                                                Tu navegador no soporta la etiqueta de video.
                                            </video>
                                        </div>
                                    ` : ''}
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Publicado el ${new Date(news.created_at).toLocaleDateString()}</small>
                                </div>
                            </div>
                        `;
                        eventsContainer.appendChild(newsCard);
                    });
                })
                .catch(error => console.error('Error fetching news:', error));

            // Cargar Videos
            fetch('/api/videos')
                .then(response => response.json())
                .then(data => {
                    const videosContainer = document.getElementById('featured-videos');
                    data.forEach(video => {
                        const videoCard = document.createElement('div');
                        videoCard.classList.add('col-md-6', 'mb-4');
                        videoCard.innerHTML = `
                            <div class="card h-100 shadow-sm">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" controls>
                                        <source src="/storage/${video.video}" type="video/mp4">
                                        Tu navegador no soporta la etiqueta de video.
                                    </video>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">${video.title}</h5>
                                    <p class="card-text text-muted">${video.description}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Publicado el ${new Date(video.created_at).toLocaleDateString()}</small>
                                </div>
                            </div>
                        `;
                        videosContainer.appendChild(videoCard);
                    });
                })
                .catch(error => console.error('Error fetching videos:', error));      
    </script>
  
   <script>
        document.addEventListener('scroll', function() {
            const scrollToTopButton = document.querySelector('.scroll-to-top');
            if (window.scrollY > 200) {
                scrollToTopButton.style.display = 'block';
            } else {
                scrollToTopButton.style.display = 'none';
            }
        });

        document.querySelector('.scroll-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>  

</body>
</html>
