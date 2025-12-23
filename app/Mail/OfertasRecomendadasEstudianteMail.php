<?php

namespace App\Mail;

use App\Models\Estudiante;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class OfertasRecomendadasEstudianteMail extends Mailable
{
    use Queueable, SerializesModels;

    public Estudiante $estudiante;
    public Collection $ofertas;

    public function __construct(Estudiante $estudiante, Collection $ofertas)
    {
        $this->estudiante = $estudiante;
        $this->ofertas = $ofertas;
    }

    public function build()
    {
        $nombre = $this->estudiante->usuario->nombre ?? 'Estudiante';

        return $this
            ->from(
                config('mail.from.address'),
                config('mail.from.name')
            )
            ->subject('📌 Ofertas recomendadas para ti (CFT Magallanes)')
            ->view('emails.ofertas-recomendadas-estudiante')
            ->with([
                'nombre'  => $nombre,
                'ofertas' => $this->ofertas,
            ]);
    }
}
