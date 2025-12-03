@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('container')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="card card-primary card-outline card-custom p-2">
        <div class="container text-center">
            <h1>Datos de: {{ $usuario->name }} {{ $usuario->apellido }}</h1>
        </div>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-container">
                            <div class="card card-primary card-outline p-2">
                                <div class="card-header">
                                    <h1 class="card-title"><i class="fa-solid fa-user"></i>Datos de Usuario</h1>
                                </div>
                                <form id="updateUserForm" action="{{ route('listausuario.update', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-12 mb-3">
                                                <label for="name" class="form-label">Nombres:</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $usuario->name }}" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="apellido" class="form-label">Apellidos:</label>
                                                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $usuario->apellido }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 mb-3">
                                                <label for="email" class="form-label">Email:</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $usuario->email }}" required>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-success" onclick="confirmUpdateUser()">
                                                <i class="fa-solid fa-pen-to-square"></i> Actualizar Usuario
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center mt-4">
            <button onclick="window.history.back();" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </button>
        </div>
    </div>

    <script>
        function confirmUpdateUser() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateUserForm').submit();
                }
            })
        }
    </script>
</body>
</html>
@endsection
