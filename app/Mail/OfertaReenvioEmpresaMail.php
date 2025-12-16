<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfertaReenvioEmpresaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $empresa;
    public string $titulo;
    public string $motivo;

    /**
     * Create a new message instance.
     */
    public function __construct(string $empresa, string $titulo, string $motivo)
    {
        $this->empresa = $empresa;
        $this->titulo  = $titulo;
        $this->motivo  = $motivo;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Correcciones solicitadas para tu oferta laboral')
            ->view('emails.oferta-reenvio-empresa');
    }
}
