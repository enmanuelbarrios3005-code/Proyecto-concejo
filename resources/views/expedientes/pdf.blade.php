<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente - {{ $expediente->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            font-size: 14px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #09539c;
            margin-top: 5px;
        }
        .membrete {
            text-align: center;
            margin-bottom: 1x;
            font-weight: bold;
        }
        .membrete img {
            max-width: 400px;
            height: auto;
            margin-bottom: 10px;
        }
        .membrete .logo {
            max-width: 50px;
            height: auto;
            margin-bottom: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dddddd;
        }
        .table th {
            background-color: #e9ecef;
            color: #09539c;
            font-weight: bold;
            width: 30%;
        }
        .image-section {
            text-align: center;
            margin: 20px 0;
        }
        .image-section img {
            width: 150px; /* Tamaño fijo */
            height: 150px; /* Tamaño fijo */
            border: 1px solid #ddd;
            border-radius: 10px;
            object-fit: cover; /* Mantener proporciones sin deformar */
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="membrete">
            <img src="{{ public_path('img/me.png') }}" alt="Membrete de la Institución">
            <h2>CONCEJO MUNICIPAL MUNICIPIO ESCUQUE</h2>
            <img class="logo" src="{{ public_path('img/logo.png') }}" alt="Logo de la Institución">
            <p>Direccion: Palacio Municipal. Frente a la Plaza Bolivar-Escuque. Despacho del Concejo Municipal.</p>
            <p>Correo: camaramunicipalescuque@gmail.com</p>
            <p>Telefonos: 0271-2951065/2950405</p>
        </div>
        <div class="image-section">
            <h2>Empleado</h2>
            @if($expediente->imagen)
                <img src="{{ public_path('storage/' . $expediente->imagen) }}" alt="Imagen del Expediente">
            @else
                <p>No hay imagen disponible.</p>
            @endif
        </div>
        <table class="table">
            <tr>
                <th>N°</th>
                <td>{{ $expediente->id }}</td>
            </tr>
            <tr>
                <th>Usuario Vinculado</th>
                <td>{{ $expediente->user ? $expediente->user->email : 'No asignado' }}</td>
            </tr>
            <tr>
                <th>Nombres</th>
                <td>{{ $expediente->user ? $expediente->user->name : 'No asignado' }}</td>
            </tr>
            <tr>
                <th>Apellidos</th>
                <td>{{ $expediente->user ? $expediente->user->apellido : 'No asignado' }}</td>
            </tr>
            <tr>
                <th>Cédula</th>
                <td>{{ $expediente->cedula }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $expediente->telefono }}</td>
            </tr>
            <tr>
                <th>Número de Cuenta</th>
                <td>{{ $expediente->numero_cuenta }}</td>
            </tr>
            <tr>
                <th>Fecha de Ingreso</th>
                <td>{{ $expediente->fecha_ingreso }}</td>
            </tr>           
            <tr>
                <th>Cargo</th>
                <td>{{ $expediente->cargo }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>Este documento es confidencial y está destinado únicamente para el uso de la persona o entidad a la que se dirige.</p>
        </div>
    </div>
</body>
</html>
