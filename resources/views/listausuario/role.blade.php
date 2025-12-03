@extends('layouts.app')
@section('title', 'Cambiar Rol de Usuario')
@section('container')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Rol de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="card card-primary card-outline card-custom p-2">
        <div class="container text-center">
            <h1>Cambiar Rol de: {{ $usuario->name }} {{ $usuario->apellido }}</h1>
        </div>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary card-outline p-2">
                            <div class="card-header">
                                <h1 class="card-title"> <i class="fa-solid fa-user"></i> Seleccionar Nuevo Rol</h1>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('listausuario.updateRole', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Rol</label>
                                        <select class="form-select" id="role" name="role">
                                            @foreach($roles as $role)
                                                @if(in_array($role->name, ['empleado', 'administrador']))
                                                    <option value="{{ $role->name }}" {{ $usuario->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-solid fa-save"></i> Cambiar Rol
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Botón para regresar a la página anterior -->
        <div class="text-center mt-4">
            <button onclick="window.history.back();" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </button>
        </div>
    </div>
</body>
</html>
@endsection
