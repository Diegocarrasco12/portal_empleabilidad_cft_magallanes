<?php

namespace App\Services;

use App\Models\Estudiante;
use App\Models\OfertaTrabajo;
use Illuminate\Support\Collection;

class OfertaRecommendationService
{
    /**
     * Obtener ofertas recomendadas para un estudiante.
     * 
     * @param Estudiante $estudiante
     * @param int $limit
     * @return Collection
     */
    public function getRecomendadas(Estudiante $estudiante, int $limit = 6): Collection
    {
        // Aquí irá la lógica completa luego
        return collect([]);
    }

    /**
     * Calcular el puntaje de una oferta para un estudiante.
     * 
     * @param Estudiante $estudiante
     * @param OfertaTrabajo $oferta
     * @return int
     */
    private function calcularPuntaje(Estudiante $estudiante, OfertaTrabajo $oferta): int
    {
        // Aquí irá el sistema de puntos
        return 0;
    }

    /**
     * Normalización cuando no hay suficientes recomendaciones.
     * 
     * @param Estudiante $estudiante
     * @return Collection
     */
    private function normalizar(Estudiante $estudiante): Collection
    {
        // Aquí irá la normalización
        return collect([]);
    }
}
