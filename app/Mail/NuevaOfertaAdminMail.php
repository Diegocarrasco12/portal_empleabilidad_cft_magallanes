<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaOfertaAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $empresa;
    public string $oferta;

    public function __construct(string $empresa, string $oferta)
    {
        $this->empresa = $empresa;
        $this->oferta  = $oferta;
    }

    public function build()
    {
        return $this
            ->subject('Nueva oferta pendiente de aprobación')
            ->view('emails.nueva-oferta-admin')
            ->with([
                'empresa' => $this->empresa,
                'oferta'  => $this->oferta,
            ]);
    }
}
