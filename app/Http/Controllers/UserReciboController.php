<?php

namespace App\Http\Controllers;

use App\DataTables\TrabajadorsIndividualDataTable;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Http\Request;

class UserReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TrabajadorsIndividualDataTable $dataTable)
    {
        $trabajador = Trabajador::where('cedula', auth()->user()->cedula)->latest()->first();

        if (!$trabajador) {
            abort(403, 'EL USUARIO NO PUEDE REALIZAR ESTA ACCIÓN');
        }

        if ($trabajador->cuenta == 0) {
            abort(403, 'HA OCURRIDO UN ERROR AL INTENTAR PROCESAR LA INFORMACIÓN, POR FAVOR CONSULTAR EN SU COORDINACIÓN DE ADMINISTRACIÓN DE TALENTO HUMANO');
        }

        $trabajadorId = $trabajador->id;
        
        return $dataTable->with('trabajadorId', $trabajadorId)->render('trabajadors.show', compact('trabajador'));

    }

}
