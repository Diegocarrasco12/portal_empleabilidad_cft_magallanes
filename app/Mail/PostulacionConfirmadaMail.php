<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostulacionConfirmadaMail extends Mailable
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
        return $this->subject('Postulación enviada correctamente')
            ->view('emails.postulacion-confirmada')
            ->with([
                'nombre' => $this->nombre,
                'oferta' => $this->oferta,
            ]);
    }
}
