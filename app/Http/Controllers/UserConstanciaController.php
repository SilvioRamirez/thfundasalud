<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\UbicacionFisica;
use Illuminate\Http\Request;

class UserConstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajador = Trabajador::where('cedula', auth()->user()->cedula)->first();

        if (!$trabajador) {
            abort(403, 'EL USUARIO NO PUEDE REALIZAR ESTA ACCIÓN');
        }

        if ($trabajador->cuenta == 0) {
            abort(403, 'HA OCURRIDO UN ERROR AL INTENTAR PROCESAR LA INFORMACIÓN, POR FAVOR CONSULTE SU ESTATUS CON SU COORDINACIÓN DE ADMINISTRACIÓN DE TALENTO HUMANO');
        }

        $ubicacion_fisicas = UbicacionFisica::where('constancia', true)->get();
        
        return view('trabajadors.constancia', compact('trabajador', 'ubicacion_fisicas'));

    }
}
