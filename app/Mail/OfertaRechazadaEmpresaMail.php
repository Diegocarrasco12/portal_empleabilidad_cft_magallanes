<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfertaRechazadaEmpresaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $empresa;
    public string $titulo;
    public string $motivo;

    public function __construct(string $empresa, string $titulo, string $motivo)
    {
        $this->empresa = $empresa;
        $this->titulo  = $titulo;
        $this->motivo  = $motivo;
    }

    public function build()
    {
        return $this
            ->subject('Oferta rechazada – Requiere correcciones')
            ->view('emails.oferta-rechazada-empresa')
            ->with([
                'empresa' => $this->empresa,
                'titulo'  => $this->titulo,
                'motivo'  => $this->motivo,
            ]);
    }
}
