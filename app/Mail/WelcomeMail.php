<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function build()
    {
        return $this
            ->subject('Bienvenido/a al Portal de Empleabilidad CFT Magallanes')
            ->view('emails.welcome');
    }
}
