<div class="container-fluid">
    <div class="card card-primary card-outline p-2">
        <div class="card-header">
            <h3 class="card-title">Listado de Usuarios</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Nivel de Usuario</th>
                            <th>Imagen</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->apellido }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <span class="{{ $usuario->status ? 'text-success' : 'text-danger' }}">
                                        {{ $usuario->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    @foreach($usuario->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @if($usuario->imagens->isNotEmpty())
                                        <img src="{{ $usuario->imagens->first()->url }}" alt="Imagen de usuario" style="width: 50px; height: 50px;">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('listausuario.edit', $usuario->id) }}" class="btn btn-warning btn-icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                                
                                <td>
                                    @if(!$usuario->hasRole('superadministrador'))
                                        <form action="{{ route('listausuario.destroy', $usuario->id) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if(!$usuario->hasRole('superadministrador'))
                                        <a href="{{ route('listausuario.editRole', $usuario->id) }}" class="btn btn-primary btn-icon">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos profesionales para DataTable (los mismos que tenías) */
    #example {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
    }
    /* ... (resto de tus estilos) ... */
</style>

<style>
    /* Centrar contenido en celdas de la tabla */
    td, th {
        text-align: center;
        vertical-align: middle;
    }

    /* ... (otros estilos de tu tabla) ... */

    /* Estilo para los botones dentro de la tabla */
    .btn-icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        padding: 5px;
        font-size: 14px;
        text-align: center;
        line-height: 1;
    }

    /* Ancho fijo para las celdas de los botones */
    td:nth-child(8), /* Editar */
    td:nth-child(9), /* Eliminar */
    td:nth-child(10) /* Rol */
    {
        width: 40px; /* Ajusta este valor según sea necesario */
    }
</style>
