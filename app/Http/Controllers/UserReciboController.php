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
        $trabajador = Trabajador::where('cedula', auth()->user()->cedula)->first();

        $trabajadorId = $trabajador->id;
        
        return $dataTable->with('trabajadorId', $trabajadorId)->render('trabajadors.show', compact('trabajador'));

    }

    public function show(Trabajador $trabajador, TrabajadorsIndividualDataTable $dataTable)
    {
        /* return view('trabajadors.show', compact('trabajador')); */
        /* return $dataTable->render('trabajadors.show', compact('trabajador')); */

        /* return $trabajador; */

        /* return $trabajador->with('primeraQuincena', 'segundaQuincena')->find($trabajador->id); *//* $users = User::with('podcasts')->get(); */

        $trabajadorId = $trabajador->id;

        return $dataTable->with('trabajadorId', $trabajadorId)->render('trabajadors.show', compact('trabajador'));

    }

}
