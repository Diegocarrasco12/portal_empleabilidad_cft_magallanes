<?php

namespace App\Services;

use App\Models\Estudiante;
use App\Models\OfertaTrabajo;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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
        // 1. Cargar todas las ofertas activas
        $ofertas = OfertaTrabajo::where('estado', 1) // 1 = activa
            ->get();

        // 2. Mapear cada oferta asignando puntaje
        $conPuntaje = $ofertas->map(function ($oferta) use ($estudiante) {
            $oferta->puntaje = $this->calcularPuntaje($estudiante, $oferta);
            return $oferta;
        });

        // 3. Filtrar solo ofertas con puntaje alto
        $filtradas = $conPuntaje->filter(function ($o) {
            return $o->puntaje > 0;
        });

        // 4. Ordenar por puntaje descendente
        $ordenadas = $filtradas->sortByDesc('puntaje')->values();

        // 5. Tomar las primeras N
        $recomendadas = $ordenadas->take($limit);

        // 6. Si hay menos de 3, aplicar normalización
        if ($recomendadas->count() < 3) {
            $extra = $this->normalizar($estudiante, $limit - $recomendadas->count());
            return $recomendadas->merge($extra);
        }

        return $recomendadas;
    }

    /**
     * Calcular el puntaje de una oferta según coincidencia con el estudiante.
     *
     * @param Estudiante $estudiante
     * @param OfertaTrabajo $oferta
     * @return int
     */
    private function calcularPuntaje(Estudiante $estudiante, OfertaTrabajo $oferta): int
    {
        $puntaje = 0;

        // ------------------------------------------
        // 1. Coincidencia por área de interés
        // ------------------------------------------
        if ($estudiante->area_interes_id && $oferta->area_id == $estudiante->area_interes_id) {
            $puntaje += 50;
        }

        // ------------------------------------------
        // 2. Coincidencia por carrera (solo si existe texto)
        // ------------------------------------------
        if ($estudiante->carrera && $oferta->descripcion) {
            $carreraLower = mb_strtolower($estudiante->carrera);
            $descLower = mb_strtolower($oferta->descripcion);

            if (strpos($descLower, $carreraLower) !== false) {
                $puntaje += 30;
            }
        }

        // ------------------------------------------
        // 3. Coincidencia por ciudad
        // ------------------------------------------
        if (
            $estudiante->ciudad &&
            $oferta->ciudad &&
            mb_strtolower($estudiante->ciudad) === mb_strtolower($oferta->ciudad)
        ) {
            $puntaje += 20;
        }

        // ------------------------------------------
        // 4. Estado académico compatible
        // ------------------------------------------
        if ($estudiante->estado_carrera) {
            $estado = mb_strtolower($estudiante->estado_carrera);

            if (in_array($estado, ['egresado', 'titulado']) && $oferta->sueldo_min > 0) {
                $puntaje += 10;
            }
        }

        // ------------------------------------------
        // 5. Recencia de la oferta
        // ------------------------------------------
        $fecha = Carbon::parse($oferta->creado_en);
        if ($fecha->greaterThan(Carbon::now()->subDays(30))) {
            $puntaje += 5;
        }

        return $puntaje;
    }

    /**
     * Normalización: si hay pocas recomendaciones,
     * se rellena con ofertas del mismo sector, ciudad o recientes.
     *
     * @param Estudiante $estudiante
     * @param int $faltantes
     * @return Collection
     */
    private function normalizar(Estudiante $estudiante, int $faltantes): Collection
    {
        $result = collect();

        // ------------------------------------------
        // 1. Rellenar con ofertas del mismo área
        // ------------------------------------------
        if ($estudiante->area_interes_id) {
            $areaMatches = OfertaTrabajo::where('estado', 1)
                ->where('area_id', $estudiante->area_interes_id)
                ->take($faltantes)
                ->get();

            $result = $result->merge($areaMatches);
            $faltantes -= $areaMatches->count();
        }

        if ($faltantes <= 0) return $result;

        // ------------------------------------------
        // 2. Rellenar con ofertas de la misma ciudad
        // ------------------------------------------
        if ($estudiante->ciudad) {
            $ciudadMatches = OfertaTrabajo::where('estado', 1)
                ->where('ciudad', $estudiante->ciudad)
                ->take($faltantes)
                ->get();

            $result = $result->merge($ciudadMatches);
            $faltantes -= $ciudadMatches->count();
        }

        if ($faltantes <= 0) return $result;

        // ------------------------------------------
        // 3. Rellenar con ofertas recientes globales
        // ------------------------------------------
        $recientes = OfertaTrabajo::where('estado', 1)
            ->orderBy('creado_en', 'desc')
            ->take($faltantes)
            ->get();

        return $result->merge($recientes);
    }
}
