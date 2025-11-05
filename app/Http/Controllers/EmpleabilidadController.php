<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class EmpleabilidadController extends Controller
{
    // 🔹 Versión simple: fuente “estática” por ahora
    private function recursos()
    {
        return [
            [
                'title'   => 'Cómo prepararte para una entrevista',
                'slug'    => 'como-prepararte-entrevista',
                'excerpt' => 'Checklist y preguntas frecuentes para enfrentar tu entrevista con seguridad.',
                'cover'   => '/img/otros/ent.png',
                'date'    => '2025-11-01',
            ],
            [
                'title'   => '5 consejos para un CV exitoso',
                'slug'    => 'cv-exitoso-en-5-pasos',
                'excerpt' => 'Estructura, logros medibles y ATS-friendly para destacar.',
                'cover'   => '/img/otros/cv.png',
                'date'    => '2025-11-02',
            ],
            [
                'title'   => 'Tendencias laborales en Magallanes',
                'slug'    => 'tendencias-laborales-magallanes',
                'excerpt' => 'Sectores con mayor demanda de técnicos y habilidades más solicitadas.',
                'cover'   => '/img/otros/sin-titulo-1.png',
                'date'    => '2025-11-03',
            ],
        ];
    }

    public function index()
    {
        $recursos = collect($this->recursos());
        return view('empleabilidad.index', compact('recursos'));
    }

    public function show($slug)
    {
        $recurso = collect($this->recursos())->firstWhere('slug', $slug);

        abort_if(!$recurso, 404);

        // 🔸 por ahora cuerpo básico; luego vendrá desde BD
        $recurso['body'] = "
            <p>Contenido del recurso «{$recurso['title']}». Aquí irán las secciones con imágenes,
            ejemplos y consejos prácticos. Más adelante lo moveremos a BD y editor.</p>
        ";

        return view('empleabilidad.show', compact('recurso'));
    }
}
