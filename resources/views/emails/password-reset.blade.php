<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
</head>

<body>
    <p>Hola,</p>

    <p>
        Has solicitado restablecer tu contraseña en el
        <strong>Portal de Empleabilidad CFT Magallanes</strong>.
    </p>

    <p>
        Haz clic en el siguiente enlace para continuar:
    </p>

    <p>
        <a href="{{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}">
            Restablecer contraseña
        </a>

    </p>

    <p>
        Este enlace expirará en 60 minutos.
    </p>

    <p>
        Si no solicitaste este cambio, puedes ignorar este correo.
    </p>

    <p>
        Saludos,<br>
        CFT Magallanes
    </p>
</body>

</html>
