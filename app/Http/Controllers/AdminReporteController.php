<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| AdminReporteController
|--------------------------------------------------------------------------
| - Muestra resumen general del sistema
| - Exporta reportes a Excel y PDF
| - SOLO LECTURA (no modifica datos)
|--------------------------------------------------------------------------
*/

class AdminReporteController extends Controller
{
    /* =========================================================
       VISTA PRINCIPAL DE REPORTES
    ========================================================= */
    public function index()
    {
        $data = $this->getReportData();

        return view('admin.reportes.index', $data);
    }

    /* =========================================================
       EXPORTAR A EXCEL
    ========================================================= */
    public function exportExcel()
    {
        $data = $this->getReportData();

        $filename = 'reporte_empleabilidad_' . now()->format('Ymd_His') . '.xls';

        return response()->streamDownload(function () use ($data) {

            // ===============================
            // ENCABEZADO GENERAL
            // ===============================
            echo "REPORTE GENERAL CFT MAGALLANES\n";
            echo "Generado el: " . now()->format('d-m-Y H:i') . "\n\n";

            // ===============================
            // RESUMEN
            // ===============================
            echo "RESUMEN GENERAL\n";
            echo "Empresas\tEstudiantes\tOfertas Activas\tPostulaciones\n";
            echo "{$data['empresas']}\t{$data['estudiantes']}\t{$data['ofertas_activas']}\t{$data['postulaciones']}\n\n";

            // ===============================
            // DETALLE EMPRESAS
            // ===============================
            echo "DETALLE DE EMPRESAS\n";
            echo "ID\tNombre Comercial\tEmail\tRUT\tFecha Creación\n";

            foreach ($data['empresas_list'] as $e) {
                echo "{$e->id}\t{$e->nombre}\t{$e->email}\t{$e->rut}\t{$e->creado_en}\n";
            }

            echo "\n";

            // ===============================
            // DETALLE ESTUDIANTES
            // ===============================
            echo "DETALLE DE ESTUDIANTES\n";
            echo "ID\tNombre Completo\tEmail\n";

            foreach ($data['estudiantes_list'] as $s) {
                $nombreCompleto = trim($s->nombre . ' ' . $s->apellido);
                echo "{$s->id}\t{$nombreCompleto}\t{$s->email}\n";
            }
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }


    /* =========================================================
       EXPORTAR A PDF
    ========================================================= */
    public function exportPdf()
    {
        $data = $this->getReportData();

        $html = view('admin.reportes.pdf', $data)->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);

        return $pdf->download(
            'reporte_empleabilidad_' . now()->format('Ymd_His') . '.pdf'
        );
    }

    /* =========================================================
       MÉTODO CENTRAL DE DATOS (ÚNICA FUENTE)
    ========================================================= */
    private function getReportData(): array
    {
        return [
            // Totales
            'empresas'        => DB::table('empresas')->count(),
            'estudiantes'     => DB::table('usuarios')->where('rol_id', 3)->count(),
            'ofertas_activas' => DB::table('ofertas_trabajo')->where('estado', 1)->count(),
            'postulaciones'   => DB::table('postulaciones')->count(),

            // Listados (para exportación)
            'empresas_list' => DB::table('empresas')
                ->select(
                    'id',
                    'nombre_comercial as nombre',
                    'correo_contacto as email',
                    'rut',
                    'creado_en'
                )
                ->orderBy('id', 'desc')
                ->get(),


            'estudiantes_list' => DB::table('usuarios')
                ->where('rol_id', 3)
                ->select('id', 'nombre', 'apellido', 'email')
                ->orderBy('id', 'desc')
                ->get(),
        ];
    }
}
