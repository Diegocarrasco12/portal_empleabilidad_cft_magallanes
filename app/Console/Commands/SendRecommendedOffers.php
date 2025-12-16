<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estudiante;
use App\Services\OfertaRecommendationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfertasRecomendadasEstudianteMail;

class SendRecommendedOffers extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'ofertas:enviar-recomendadas';

    /**
     * The console command description.
     */
    protected $description = 'Envía correos quincenales con ofertas recomendadas a estudiantes';

    /**
     * Execute the console command.
     */
    public function handle(OfertaRecommendationService $service)
    {
        $this->info('🔎 Buscando estudiantes activos...');

        $estudiantes = Estudiante::with('usuario')
            ->whereHas('usuario', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->get();

        if ($estudiantes->isEmpty()) {
            $this->warn('⚠️ No hay estudiantes activos.');
            return;
        }

        foreach ($estudiantes as $estudiante) {

            if (!$estudiante->usuario || !$estudiante->usuario->email) {
                continue;
            }

            // Obtener ofertas recomendadas usando TU algoritmo
            $ofertas = $service->getRecomendadas($estudiante, 6);

            if ($ofertas->isEmpty()) {
                $this->line("⏭ {$estudiante->usuario->email} sin ofertas recomendadas");
                continue;
            }

            // Enviar correo
            Mail::to($estudiante->usuario->email)->send(
                new OfertasRecomendadasEstudianteMail(
                    $estudiante,
                    $ofertas
                )
            );

            $this->info("📧 Correo enviado a {$estudiante->usuario->email}");
        }

        $this->info('✅ Proceso finalizado correctamente.');
    }
}
