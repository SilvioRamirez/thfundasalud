<?php

namespace App\Http\Controllers;

use App\Models\PrimeraQuincena;
use App\Models\SegundaQuincena;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use App\Models\UbicacionFisica;

class ReciboArcController extends Controller
{
    /**
     * Genera la Planilla ARC (Anticipos de Renta Consolidada) anual del trabajador
     */
    public function recibo_arc_pdf(string $cedula, string $ano)
    {
        // Buscar el trabajador por cédula y año (tomar el registro más reciente del año)
        $trabajador = Trabajador::where('cedula', $cedula)
            ->where('ano', $ano)
            ->orderBy('mes', 'desc')
            ->first();

        if (!$trabajador) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }

        // Obtener todos los registros de primera y segunda quincena del año
        $primerasQuincenas = PrimeraQuincena::where('cedula', $cedula)
            ->where('ano', $ano)
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy('mes');

        $segundasQuincenas = SegundaQuincena::where('cedula', $cedula)
            ->where('ano', $ano)
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy('mes');

        // Calcular datos mensuales y anuales
        $datosMensuales = [];
        $totalAnualAsignaciones = 0;
        $deduccionesLey = [
            'sso' => 0,
            'paro_forzoso' => 0,
            'faov' => 0,
            'fondo_jubilacion' => 0,
            'impuesto_renta' => 0
        ];

        for ($mes = 1; $mes <= 12; $mes++) {
            $primera = $primerasQuincenas->get($mes);
            $segunda = $segundasQuincenas->get($mes);

            if ($primera && $segunda) {
                // Total asignaciones del mes
                $totalMes = $primera->total_asignaciones + $segunda->total_asignaciones;
                $totalAnualAsignaciones += $totalMes;

                // Deducciones de ley
                $deduccionesLey['sso'] += ($primera->sso ?? 0) + ($segunda->sso ?? 0);
                $deduccionesLey['paro_forzoso'] += ($primera->paro_forzoso ?? 0) + ($segunda->paro_forzoso ?? 0);
                $deduccionesLey['faov'] += ($primera->faov ?? 0) + ($segunda->faov ?? 0);
                $deduccionesLey['fondo_jubilacion'] += ($primera->fondo_de_jubilacion ?? 0) + ($segunda->fondo_de_jubilacion ?? 0);
                // Asumiendo que el impuesto sobre la renta está en un campo llamado 'impuesto_renta' o similar
                // Ajusta el nombre del campo según tu base de datos

                $datosMensuales[$mes] = $totalMes;
            } else {
                $datosMensuales[$mes] = 0;
            }
        }

        // Calcular total de deducciones de ley
        $totalDeduccionesLey = array_sum($deduccionesLey);

        // Genera la fecha en que se genera el PDF
        $fecha = now();

        // Preparar la ruta del código QR
        $ruta = route('recibo_arc.verify', [$trabajador->id, $trabajador->cedula, $ano]);

        $ubicacion_fisica = UbicacionFisica::where('id', auth()->user()->ubicacion_fisica_id)->first();

        $pdf = PDF::loadView('trabajadors.pdf.planilla_arc', compact(
            'trabajador',
            'fecha',
            'ruta',
            'datosMensuales',
            'totalAnualAsignaciones',
            'deduccionesLey',
            'totalDeduccionesLey',
            'ano',
            'ubicacion_fisica'
        ))->setPaper('A4', 'portrait');

        //return  $pdf->stream();

        return $pdf->download('Planilla ARC ' . $trabajador->cedula . '_' . $ano . '.pdf');
    }

    /**
     * Verifica la Planilla ARC mediante código QR
     */
    public function recibo_arc_verify(string $id, string $cedula, string $ano)
    {
        // Buscar el trabajador por Id y año
        $trabajadorId = Trabajador::where('id', $id)->where('ano', $ano)->first();

        if (!$trabajadorId) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTA PLANILLA ARC');
        }

        // Buscar el trabajador por cédula
        $trabajadorCedula = Trabajador::where('cedula', $cedula)->where('ano', $ano)->first();

        if (!$trabajadorCedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTA PLANILLA ARC');
        }
        
        // Comparamos el ID de la consulta con la cedula
        if ($trabajadorId->cedula != $trabajadorCedula->cedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTA PLANILLA ARC');
        }

        // Buscar registros de primera y segunda quincena para el año completo
        $primerasQuincenas = PrimeraQuincena::where('cedula', $cedula)
            ->where('ano', $ano)
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy('mes');

        $segundasQuincenas = SegundaQuincena::where('cedula', $cedula)
            ->where('ano', $ano)
            ->orderBy('mes', 'asc')
            ->get()
            ->keyBy('mes');

        if ($primerasQuincenas->isEmpty() || $segundasQuincenas->isEmpty()) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTA PLANILLA ARC - NO HAY DATOS DISPONIBLES');
        }

        // Calcular datos mensuales y anuales
        $datosMensuales = [];
        $totalAnualAsignaciones = 0;
        $deduccionesLey = [
            'sso' => 0,
            'paro_forzoso' => 0,
            'faov' => 0,
            'fondo_jubilacion' => 0,
            'impuesto_renta' => 0
        ];

        for ($mes = 1; $mes <= 12; $mes++) {
            $primera = $primerasQuincenas->get($mes);
            $segunda = $segundasQuincenas->get($mes);

            if ($primera && $segunda) {
                $totalMes = $primera->total_asignaciones + $segunda->total_asignaciones;
                $totalAnualAsignaciones += $totalMes;

                $deduccionesLey['sso'] += ($primera->sso ?? 0) + ($segunda->sso ?? 0);
                $deduccionesLey['paro_forzoso'] += ($primera->paro_forzoso ?? 0) + ($segunda->paro_forzoso ?? 0);
                $deduccionesLey['faov'] += ($primera->faov ?? 0) + ($segunda->faov ?? 0);
                $deduccionesLey['fondo_jubilacion'] += ($primera->fondo_de_jubilacion ?? 0) + ($segunda->fondo_de_jubilacion ?? 0);

                $datosMensuales[$mes] = $totalMes;
            } else {
                $datosMensuales[$mes] = 0;
            }
        }

        $totalDeduccionesLey = array_sum($deduccionesLey);

        return view('trabajadors.web_consulta_arc', compact(
            'trabajadorCedula',
            'datosMensuales',
            'totalAnualAsignaciones',
            'deduccionesLey',
            'totalDeduccionesLey',
            'ano'
        ));
    }

    public function arc_check_cedula(Request $request)
    {
        $cedula = $request->cedula;
        $ano = date('Y');
        
        $trabajador = Trabajador::where('cedula', $cedula)->latest()->first();;


        if (!$trabajador) {
            abort(403, 'EL USUARIO NO PUEDE REALIZAR ESTA ACCIÓN');
        }

        if ($trabajador->cuenta == 0) {
            abort(403, 'HA OCURRIDO UN ERROR AL INTENTAR PROCESAR LA INFORMACIÓN, POR FAVOR CONSULTAR EN SU COORDINACIÓN DE ADMINISTRACIÓN DE TALENTO HUMANO');
        }

        $trabajadorId = $trabajador->id;
        
        return view('trabajadors.show_arc', compact('trabajador'));

    }

    public function arc_check()
    {
        return view('arc.check');
    }
}
