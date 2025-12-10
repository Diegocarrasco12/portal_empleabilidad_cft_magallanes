<?php

namespace App\Http\Controllers;

use App\Models\OfertaTrabajo;
use App\Models\AreaEmpleo;
use App\Models\TipoContrato;
use App\Models\Modalidad;
use App\Models\Jornada;
use Illuminate\Http\Request;

class OfertaPublicaController extends Controller
{
    /**
     * Página pública principal de ofertas laborales.
     *
     * - Muestra solo ofertas vigentes:
     *   estado = ESTADO_APROBADA (1)
     *   fecha_cierre >= hoy O NULL
     * - Orden base: más recientes primero (creado_en)
     * - Incluye relaciones necesarias para mostrar empresa, área, etc.
     */
    public function index(Request $request)
    {
        // Query base con relaciones
        $query = OfertaTrabajo::with([
            'empresa',
            'area',
            'tipoContrato',
            'modalidad',
            'jornada',
        ])
            ->vigentes()
            ->orderBy('creado_en', 'desc');
        // 🔍 Filtro por Jornada
        if ($request->filled('j')) {
            $query->where('jornada_id', $request->j);
        }

        // Filtro de búsqueda por texto (q)
        if ($request->filled('q')) {
            $search = trim($request->q);

            $query->where(function ($q2) use ($search) {
                $q2->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('descripcion', 'LIKE', "%{$search}%")
                    ->orWhere('requisitos', 'LIKE', "%{$search}%")
                    ->orWhere('habilidades_deseadas', 'LIKE', "%{$search}%")
                    ->orWhere('ciudad', 'LIKE', "%{$search}%")
                    ->orWhere('region', 'LIKE', "%{$search}%")
                    // Buscar también por nombre de empresa
                    ->orWhereHas('empresa', function ($qEmpresa) use ($search) {
                        $qEmpresa->where('nombre_comercial', 'LIKE', "%{$search}%")
                            ->orWhere('razon_social', 'LIKE', "%{$search}%");
                    });
            });
        }
        // FILTRO UBICACIÓN (ciudad/region) flexible
        if ($request->filled('l')) {
            $loc = str_replace(
                ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'],
                ['a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u'],
                strtolower($request->l)
            );

            $query->where(function ($sub) use ($loc) {
                $sub->whereRaw("LOWER(REPLACE(ciudad, 'áéíóúÁÉÍÓÚ', 'aeiouaeiou')) LIKE ?", ["%$loc%"])
                    ->orWhereRaw("LOWER(REPLACE(region, 'áéíóúÁÉÍÓÚ', 'aeiouaeiou')) LIKE ?", ["%$loc%"]);
            });
        }

        // Paginación real con queryString para filtros futuros
        $ofertas = $query->paginate(15)->withQueryString();

        return view('jobs.index', [
            'ofertas'       => $ofertas,
            'areas'         => AreaEmpleo::orderBy('nombre')->get(),
            'tiposContrato' => TipoContrato::orderBy('nombre')->get(),
            'modalidades'   => Modalidad::orderBy('nombre')->get(),
            'jornadas'      => Jornada::orderBy('nombre')->get(),

            // Dejamos mapeado a los datos del request (aunque no los usemos aún)
            'filters'       => [
                'q'     => $request->q,
                'l'     => $request->l,
                'j'     => $request->j,
                'area'  => $request->area,
                'type'  => $request->type,
                'smin'  => $request->smin,
                'smax'  => $request->smax,
                'age'   => $request->age,
                'orden' => $request->orden ?? 'reciente',
            ],
        ]);
    }
}
