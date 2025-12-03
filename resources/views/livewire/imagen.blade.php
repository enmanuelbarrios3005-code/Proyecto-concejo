<div class="text-center">
    @auth
    @if($imagens->isNotEmpty())
        <img class="profile-user-img img-fluid img-circle mb-1"
             src="{{ $imagens->first()->url }}"
             alt="User profile picture"
             style="width: 140px; height: 140px;">
    @else
        <p>No hay imágenes disponibles.</p>
    @endif
    <a href="{{route('miuser.index')}}" class="d-block user-name">{{ auth()->user()->name }} {{ auth()->user()->apellido }}</a>
    @endauth
</div>
