
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6 col-10">
            <!-- Contenedor de Cambio de Contraseña -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa-solid fa-user"></i> Cambiar Contraseña</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update') }}">
                        @csrf
                        @method('PUT')
                    
                        <div class="col-md-12">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="current_password" placeholder="Contraseña Actual" maxlength="10" id="current_password">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('current_password')">
                                        <i class="fa-solid fa-eye" id="eye-icon-current_password"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña" maxlength="10" id="new_password">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('new_password')">
                                        <i class="fa-solid fa-eye" id="eye-icon-new_password"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label for="password_confirmation" class="form-label">Repite contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" maxlength="10" id="confirm_password">
                                <div class="input-group-append">
                                    <span class="input-group-text eye-icon" onclick="togglePassword('confirm_password')">
                                        <i class="fa-solid fa-eye" id="eye-icon-confirm_password"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="alert alert-danger mt-2" role="alert">
                                Requisitos Obligatorios:
                                <br>
                                1-La contraseña debe tener al menos 10 caracteres.  <br>
                                2-Una letra mayúscula (A, B, C, D,).  <br>
                                3-Ser alfanumérica con al menos 2 números.<br>
                                4-Solo se permite una letra mayúscula.<br>
                                5-Carácteres obligatorios: (@.$/-*#=).
                            </div>
                        </div>
                    
                        <div class="card-body text-center">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-floppy-disk"></i> Confirmar
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>




        