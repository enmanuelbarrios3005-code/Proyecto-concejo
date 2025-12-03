<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Registro</title>
</head>
<body>
    <h1>Nueva Solicitud de Registro</h1>
    <p>Se ha recibido una nueva solicitud de registro con los siguientes datos:</p>
    <ul>
        <li><strong>Nombres:</strong> {{ $user->name }}</li>
        <li><strong>Apellidos:</strong> {{ $user->apellido }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
    </ul>
    <p>Por favor, revise y apruebe la solicitud.</p>
</body>
</html>