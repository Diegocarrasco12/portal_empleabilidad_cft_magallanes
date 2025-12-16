<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfertaAprobadaEmpresaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $empresa;
    public string $titulo;

    public function __construct(string $empresa, string $titulo)
    {
        $this->empresa = $empresa;
        $this->titulo  = $titulo;
    }

    public function build()
    {
        return $this
            ->subject('Tu oferta ha sido aprobada')
            ->view('emails.oferta-aprobada-empresa');
    }
}
