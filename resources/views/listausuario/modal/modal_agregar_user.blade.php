@include('auth.from.Alertas_register')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <i class="fa-solid fa-user"></i> 
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('listausuario.store') }}" method="POST" class="row g-3 needs-validation" novalidate onsubmit="validatePasswords(event)">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un nombre.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un apellido.
                        </div>
                    </div>
                    <div class="col-md-12 mb-6">
                        <label for="email" class="form-label">Correo "Email"</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un correo válido.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="password" class="form-label"> Contraseña</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Ingresa contraseña" required maxlength="10">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="invalid-feedback">
                                Por favor ingresa una contraseña.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 position-relative">
                        <label for="password_confirmation" class="form-label">Confirma Contraseña</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Repita contraseña" required maxlength="10">
                            <span class="input-group-text" id="togglePasswordConfirmation" style="cursor: pointer;">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="invalid-feedback">
                                Por favor confirma la contraseña.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-success me-3">
                            <i class="fa-solid fa-floppy-disk icono"></i> Registrarse
                        </button>
                        <button type="button" class="btn btn-secondary ms-3" data-bs-dismiss="modal">
                            <i class="fa-solid fa-ban icono"></i> Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.children[0].classList.toggle('fa-eye-slash');
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordConfirmation = document.getElementById('password_confirmation');
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        this.children[0].classList.toggle('fa-eye-slash');
    });

    function validatePasswords(event) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        if (password !== passwordConfirmation) {
            event.preventDefault();
            alert('Las contraseñas no coinciden.');
        }
    }

    // Bootstrap validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>

<style>
    .position-relative .fa-eye, .position-relative .fa-eye-slash {
        right: 1rem;
        transform: translateY(-10%);
    }

    .modal-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #0d6efd;
        color: white;
    }

    .modal-header h5 {
        margin-bottom: 0;
    }

    .btn-close-white {
        filter: invert(1);
    }

    .btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>
