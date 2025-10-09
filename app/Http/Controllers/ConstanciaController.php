<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\PrimeraQuincena;
use App\Models\SegundaQuincena;
use App\Models\UbicacionFisica;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ConstanciaController extends Controller
{
    /**
     * Genera el Recibo de pago solicitado por el trabajador
     */
    public function constancia_pdf(string $cedula, Request $request)
    {
        $trabajador = Trabajador::where('cedula', $cedula)->latest()->first();

        $trabajadorAutenticado = Trabajador::where('cedula', auth()->user()->cedula)->latest()->first();
        
        if (!$trabajador) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }

        if ($trabajadorAutenticado->cedula != $cedula) {
            abort(403, 'EL USUARIO NO PUEDE REALIZAR ESTA ACCIÓN');
        }

        $ano = $trabajador->ano;
        $mes = $trabajador->mes;

        // Cargar las relaciones filtradas por año y mes
        $trabajador->load(['primeraQuincena' => function ($query) use ($ano, $mes) {
            $query->where('ano', $ano)->where('mes', $mes);
        }, 'segundaQuincena' => function ($query) use ($ano, $mes) {
            $query->where('ano', $ano)->where('mes', $mes);
        }]);

        // Genera la fecha en q es genera el pdf
        $fecha = now();

        $turno = $request->turno;
        $cantidad_horas = $request->cantidad_horas;
        $ubicacion_fisica = $request->ubicacion_fisica;
        $jefe_inmediato = Trabajador::find($request->jefe_inmediato_id);
        $nota = $request->nota;

        // Preparar la ruta del codigo qr
        $ruta = route('constancia.verify', [$trabajador->id, $trabajador->cedula, $trabajador->primeraQuincena[0]->ano, $trabajador->primeraQuincena[0]->mes]);

        $pdf = PDF::loadView('trabajadors.pdf.constancia', compact('trabajador', 'fecha', 'ruta', 'turno', 'cantidad_horas', 'ubicacion_fisica', 'jefe_inmediato', 'nota'))
                    ->setPaper('A4','portrait');

        /* return  $pdf->stream(); */
                    
        return $pdf->download('Constancia de Trabajo '.$trabajador->cedula.'_'.$trabajador->primeraQuincena[0]->ano.'_'.$trabajador->primeraQuincena[0]->mes.'.pdf');
    }

    public function constancia_verify(string $id, string $cedula, string $ano, string $mes)
    {
        // Buscar el trabajador por Id
        $trabajadorId = Trabajador::where('id', $id)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$trabajadorId) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE CONSTANCIA DE TRABAJO');
        }

        // Buscar el trabajador por cédula
        $trabajadorCedula = Trabajador::where('cedula', $cedula)->first();

        if (!$trabajadorCedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE CONSTANCIA DE TRABAJO');
        }
        
        // Comparamos el ID de la consulta con la cedula
        if ($trabajadorId->cedula != $trabajadorCedula->cedula) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE CONSTANCIA DE TRABAJO');
        }

        //Buscamos en la primera quincena la cedula q coincida con el año y el mes solicitado
        $primeraQuincena = PrimeraQuincena::where('cedula',$cedula)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$primeraQuincena) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE CONSTANCIA DE TRABAJO');
        }

        //Buscamos en la segunda quincena la cedula q coincida con el año y el mes solicitado
        $segundaQuincena = SegundaQuincena::where('cedula',$cedula)->where('ano', $ano)->where('mes', $mes)->first();

        if (!$segundaQuincena) {
            abort(403, 'NO ES POSIBLE VERIFICAR ESTE CONSTANCIA DE TRABAJO');
        }

        $totalAsignaciones = $primeraQuincena->total_asignaciones + $segundaQuincena->total_asignaciones;

        return view('trabajadors.web_consulta', compact('trabajadorCedula', 'primeraQuincena', 'totalAsignaciones'));

    }
}
