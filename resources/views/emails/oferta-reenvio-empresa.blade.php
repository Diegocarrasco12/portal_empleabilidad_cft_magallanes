<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Correcciones solicitadas</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">

    <h2>Hola {{ $empresa }}</h2>

    <p>
        La oferta laboral titulada:
        <strong>{{ $titulo }}</strong>
        ha sido revisada por el equipo administrador.
    </p>

    <p>
        Se requieren las siguientes correcciones antes de poder aprobarla:
    </p>

    <blockquote style="background:#f8f9fa; padding:15px; border-left:4px solid #f0ad4e;">
        {{ $motivo }}
    </blockquote>

    <p>
        Puedes ingresar a tu panel de empresa, corregir la oferta y reenviarla para su revisión.
    </p>

    <p>
        Quedamos atentos.<br>
        <strong>Equipo Portal de Empleabilidad</strong>
    </p>

</body>
</html>
