<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva oferta pendiente</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f7f7f7; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#ffffff; padding:20px; border-radius:6px;">
        <h2>Nueva oferta creada</h2>

        <p>
            La empresa <strong>{{ $empresa }}</strong> ha creado una nueva oferta de trabajo.
        </p>

        <p>
            <strong>Oferta:</strong> {{ $oferta }}
        </p>

        <p>
            La oferta se encuentra pendiente de revisión y aprobación en el panel de administración.
        </p>

        <br>

        <p style="font-size:14px; color:#666;">
            CFT Magallanes – Portal de Empleabilidad
        </p>
    </div>
</body>
</html>
