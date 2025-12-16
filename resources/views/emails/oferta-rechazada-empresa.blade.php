<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Oferta rechazada</title>
</head>
<body>

<h2>Hola {{ $empresa }}</h2>

<p>
    Lamentamos informarte que la oferta:
    <strong>{{ $titulo }}</strong>
    ha sido rechazada.
</p>

<p><strong>Motivo:</strong></p>
<p>{{ $motivo }}</p>

<p>
    Puedes corregir la oferta y reenviarla desde tu panel de empresa.
</p>

<p>
    Saludos,<br>
    Equipo Empleabilidad CFT Magallanes
</p>

</body>
</html>
