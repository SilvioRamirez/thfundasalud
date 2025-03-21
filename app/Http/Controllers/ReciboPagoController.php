<?php

namespace App\Http\Controllers;

use App\Models\PrimeraQuincena;
use App\Models\SegundaQuincena;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class ReciboPagoController extends Controller
{
    /**
     * Genera el Recibo de pago solicitado por el trabajador
     */
    public function recibo_pago_pdf(string $cedula, string $ano, string $mes)
    {
        // Buscar el trabajador por cédula
        $trabajador = Trabajador::where('cedula', $cedula)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$trabajador) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }

        // Cargar las relaciones filtradas por año y mes
        $trabajador->load(['primeraQuincena' => function ($query) use ($ano, $mes) {
            $query->where('ano', $ano)->where('mes', $mes);
        }, 'segundaQuincena' => function ($query) use ($ano, $mes) {
            $query->where('ano', $ano)->where('mes', $mes);
        }]);

        // Genera la fecha en q es genera el pdf
        $fecha = now();

        // Preparar la ruta del codigo qr
        $ruta = route('recibopago.verify', [$trabajador->id, $trabajador->cedula, $trabajador->primeraQuincena[0]->ano, $trabajador->primeraQuincena[0]->mes]);

        $pdf = PDF::loadView('trabajadors.pdf.recibopago', compact('trabajador', 'fecha', 'ruta'))
                    ->setPaper('A4','portrait');

        /* return  $pdf->stream(); */
                    
        return $pdf->download('Recibo de Pago '.$trabajador->cedula.'_'.$trabajador->primeraQuincena[0]->ano.'_'.$trabajador->primeraQuincena[0]->mes.'.pdf');
    }

    public function recibo_pago_verify(string $id, string $cedula, string $ano, string $mes)
    {
        // Buscar el trabajador por Id
        $trabajadorId = Trabajador::where('id', $id)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$trabajadorId) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE RECIBO DE PAGO');
        }

        // Buscar el trabajador por cédula
        $trabajadorCedula = Trabajador::where('cedula', $cedula)->first();

        if (!$trabajadorCedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE RECIBO DE PAGO');
        }
        
        // Comparamos el ID de la consulta con la cedula
        if ($trabajadorId->cedula != $trabajadorCedula->cedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE RECIBO DE PAGO');
        }

        //Buscamos en la primera quincena la cedula q coincida con el año y el mes solicitado
        $primeraQuincena = PrimeraQuincena::where('cedula',$cedula)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$primeraQuincena) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE RECIBO DE PAGO');
        }

        //Buscamos en la segunda quincena la cedula q coincida con el año y el mes solicitado
        $segundaQuincena = SegundaQuincena::where('cedula',$cedula)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$segundaQuincena) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE RECIBO DE PAGO');
        }

        $totalAsignaciones = $primeraQuincena->total_asignaciones + $segundaQuincena->total_asignaciones;

        return view('trabajadors.web_consulta', compact('trabajadorCedula', 'primeraQuincena', 'totalAsignaciones'));

        
    }

}