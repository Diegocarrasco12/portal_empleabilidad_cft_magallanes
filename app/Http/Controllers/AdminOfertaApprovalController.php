<?php

namespace App\Http\Controllers;

use App\Models\OfertaTrabajo;
use Illuminate\Http\Request;
use App\Services\AlertMessageService;

class AdminOfertaApprovalController extends Controller
{
    public function index(Request $request)
    {
        // 1) Mapa de estados permitidos
        $estadoFiltro = $request->query('estado', 'pending'); // por defecto: pendientes

        $mapaEstados = [
            'pending'     => OfertaTrabajo::ESTADO_PENDIENTE,
            'approved'    => OfertaTrabajo::ESTADO_APROBADA,
            'rejected'    => OfertaTrabajo::ESTADO_RECHAZADA,
            'resubmitted' => OfertaTrabajo::ESTADO_REENVIADA,
            'all'         => null, // sin filtro
        ];

        // Si viene algo raro en la URL, forzamos a 'pending'
        if (! array_key_exists($estadoFiltro, $mapaEstados)) {
            $estadoFiltro = 'pending';
        }

        // 2) Query base: con empresa asociada, ordenado por fecha
        $query = OfertaTrabajo::with('empresa')->orderByDesc('creado_en');

        // 3) Aplicar filtro de estado si corresponde
        $estadoValor = $mapaEstados[$estadoFiltro];

        if ($estadoValor !== null) {
            $query->where('estado', $estadoValor);
        }

        // 4) Ejecutar con paginación
        $ofertas = $query->paginate(10)->withQueryString();

        // 5) Contadores rápidos (para mostrar en la UI)
        $stats = [
            'pending'     => OfertaTrabajo::where('estado', OfertaTrabajo::ESTADO_PENDIENTE)->count(),
            'approved'    => OfertaTrabajo::where('estado', OfertaTrabajo::ESTADO_APROBADA)->count(),
            'rejected'    => OfertaTrabajo::where('estado', OfertaTrabajo::ESTADO_RECHAZADA)->count(),
            'resubmitted' => OfertaTrabajo::where('estado', OfertaTrabajo::ESTADO_REENVIADA)->count(),
        ];

        return view('admin.ofertas.index', [
            'ofertas'       => $ofertas,
            'estadoFiltro'  => $estadoFiltro,
            'stats'         => $stats,
        ]);
    }
    public function show($id)
    {
        // Buscar oferta
        $oferta = OfertaTrabajo::findOrFail($id);

        // Retornar la vista duplicada para admins
        return view('admin.ofertas.show', compact('oferta'));
    }
    public function approve($id)
    {
        $oferta = OfertaTrabajo::findOrFail($id);

        $oferta->estado = OfertaTrabajo::ESTADO_APROBADA;
        $oferta->revisada_en = now();
        $oferta->save();

        $mensaje = AlertMessageService::mensaje('APROBADA');

        return redirect()
            ->route('admin.ofertas.show', $id)
            ->with($mensaje['type'], $mensaje['text']);
    }

    public function reject(Request $request, $id)
    {
        $oferta = OfertaTrabajo::findOrFail($id);

        $oferta->estado = OfertaTrabajo::ESTADO_RECHAZADA;
        $oferta->motivo_rechazo = $request->motivo_rechazo ?? 'Oferta rechazada.';
        $oferta->revisada_en = now();
        $oferta->save();

        $mensaje = AlertMessageService::mensaje('RECHAZADA');

        return redirect()
            ->route('admin.ofertas.show', $id)
            ->with($mensaje['type'], $mensaje['text']);
    }

    public function resubmit(Request $request, $id)
    {
        $oferta = OfertaTrabajo::findOrFail($id);

        $oferta->estado = OfertaTrabajo::ESTADO_REENVIADA;
        $oferta->motivo_rechazo = $request->motivo_rechazo ?? 'La oferta necesita correcciones.'; // opcional
        $oferta->revisada_en = now();
        $oferta->save();

        $mensaje = \App\Services\AlertMessageService::mensaje('REENVIADA');

        return redirect()
            ->route('admin.ofertas.show', $id)
            ->with($mensaje['type'], $mensaje['text']);
    }
}
