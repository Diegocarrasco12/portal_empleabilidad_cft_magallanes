<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ofertas recomendadas para ti</title>
</head>
<body style="margin:0; padding:0; background-color:#f6f7fb; font-family:Arial, Helvetica, sans-serif;">

    <div style="max-width:640px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

        {{-- HEADER --}}
        <div style="background:#C4161C; padding:20px 24px;">
            <h1 style="margin:0; color:#ffffff; font-size:20px; font-weight:bold;">
                Ofertas recomendadas para ti
            </h1>
        </div>

        {{-- BODY --}}
        <div style="padding:24px;">

            <p style="margin-top:0; color:#333; font-size:15px;">
                Hola <strong>{{ $nombre }}</strong>,
            </p>

            <p style="color:#444; font-size:14px; line-height:1.6;">
                Según tu perfil en el <strong>Portal de Empleabilidad del CFT Magallanes</strong>,
                hemos seleccionado estas ofertas que podrían ser de tu interés:
            </p>

            {{-- LISTADO OFERTAS --}}
            @foreach($ofertas as $oferta)
                <div style="border:1px solid #e5e7eb; border-radius:10px; padding:16px; margin-bottom:16px; background:#fafafa;">

                    <h3 style="margin:0 0 6px 0; font-size:16px; color:#111;">
                        {{ $oferta->titulo ?? 'Oferta laboral' }}
                    </h3>

                    <p style="margin:0; font-size:13px; color:#555;">
                        <strong>Ciudad:</strong> {{ $oferta->ciudad ?? '-' }}
                        &nbsp;|&nbsp;
                        <strong>Región:</strong> {{ $oferta->region ?? '-' }}
                    </p>

                    <p style="margin:6px 0 0 0; font-size:12px; color:#777;">
                        <strong>Publicado:</strong> {{ $oferta->creado_en ?? '-' }}
                    </p>

                    {{-- BOTÓN --}}
                    @if(isset($oferta->id))
                        <div style="margin-top:14px;">
                            <a href="{{ config('app.url') . route('ofertas.detalle', $oferta->id, false) }}"
                               style="
                                   display:inline-block;
                                   padding:10px 18px;
                                   background:#C4161C;
                                   color:#ffffff;
                                   text-decoration:none;
                                   border-radius:8px;
                                   font-size:13px;
                                   font-weight:bold;
                               ">
                                Ver oferta
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- FOOTER TEXTO --}}
            <p style="margin-top:24px; font-size:12px; color:#666; line-height:1.5;">
                Si ya postulaste a alguna de estas ofertas o no te interesa en este momento,
                puedes ignorar este correo sin problemas.
            </p>

            <p style="margin-bottom:0; font-size:12px; color:#666;">
                Saludos,<br>
                <strong>Portal de Empleabilidad</strong><br>
                CFT Magallanes
            </p>

        </div>
    </div>

</body>
</html>
