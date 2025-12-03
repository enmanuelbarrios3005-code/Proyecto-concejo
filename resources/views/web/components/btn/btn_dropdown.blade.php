<a class="btn btn-primary" href="{{ route('welcome') }}" style="margin-right: 15px; text-decoration: none;"><i class="fa-solid fa-house-laptop"></i> Inicio</a>
    <!-- Menú desplegable -->
    <div class="dropdown" style="margin-right: 15px;">
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