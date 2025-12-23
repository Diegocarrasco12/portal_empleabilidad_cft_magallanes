<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaPostulacionEmpresaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombre;
    public string $oferta;

    public function __construct(string $nombre, string $oferta)
    {
        $this->nombre = $nombre;
        $this->oferta = $oferta;
    }

    public function build()
    {
        return $this
            ->from(
                config('mail.from.address'),
                config('mail.from.name')
            )
            ->subject('Nueva postulación recibida')
            ->view('emails.nueva-postulacion-empresa')
            ->with([
                'nombre' => $this->nombre,
                'oferta' => $this->oferta,
            ]);
    }
}
