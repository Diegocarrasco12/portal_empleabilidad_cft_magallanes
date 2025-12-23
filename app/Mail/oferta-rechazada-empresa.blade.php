<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<p>Estimado/a <strong>{{ $empresa }}</strong>,</p>

<p>
Lamentamos informarle que la siguiente oferta de trabajo ha sido <strong>rechazada</strong>:
</p>

<p>
<strong>{{ $titulo }}</strong>
</p>

<p>
Motivo del rechazo:
</p>

<blockquote>
{{ $motivo }}
</blockquote>

<p>
Puede corregir la información y reenviar la oferta desde su panel de empresa.
</p>

<p>
Atentamente,<br>
<strong>Equipo Portal Empleabilidad</strong>
</p>

</body>
</html>
