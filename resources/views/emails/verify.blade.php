<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
</head>
<body>
    <h1>Hola, {{ $user->name }}</h1>
    <p>Gracias por registrarte. Por favor, verifica tu correo haciendo clic en el siguiente enlace:</p>
    <a href="{{ url('/verify/' . $user->verification_token) }}">Verificar mi correo</a>
</body>
</html>
