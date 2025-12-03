<form method="post" action="{{ url('/login') }}" id="loginForm" class="p-4 border rounded shadow-lg bg-light">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-outline mb-4">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Correo electronico" required>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-outline mb-4 position-relative">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Contraseña" required maxlength="50">
        <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 19px; top: 45px; cursor: pointer; color:  #1a1717;"></i>
    </div>
    <div class="text-center pt-1 mb-5 pb-1">
        <style>
            .btn-custom {
                background-color: #0e5faf; /* Color de fondo */
                color: white; /* Color del texto */
                border-radius: 25px; /* Bordes redondeados */
                padding: 10px 20px; /* Espaciado interno */
                transition: background-color 0.3s, transform 0.3s; /* Transiciones suaves */
            }
            .btn-custom:hover {
                background-color: #1875d3; /* Color de fondo al pasar el mouse */
                transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
            }
        </style>
        
        <button type="submit" class="btn btn-custom"><i class="fa-solid fa-up-right-from-square"></i>  Ingresar</button>
       
    </div>
    <div class="text-center">
        <p>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary">Registrarse</a></p>
        <p>¿Redirigir a la pagina principal?  <a href="{{ route('welcome') }}" class="text-primary">Sitio Web</a></p>
        
    </div>
    <br>
</form>



<script>
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>
