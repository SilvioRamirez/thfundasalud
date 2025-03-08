<?php

namespace App\Http\Controllers;

use App\DataTables\TrabajadorsDataTable;
use App\DataTables\TrabajadorsIndividualDataTable;
use App\Models\Trabajador;
use App\Http\Requests\StoreTrabajadorRequest;
use App\Http\Requests\UpdateTrabajadorRequest;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TrabajadorsDataTable $dataTable)
    {
        return $dataTable->render('trabajadors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrabajadorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajador $trabajador, TrabajadorsIndividualDataTable $dataTable)
    {
        /* return view('trabajadors.show', compact('trabajador')); */
        /* return $dataTable->render('trabajadors.show', compact('trabajador')); */

        /* return $trabajador; */

        /* return $trabajador->with('primeraQuincena', 'segundaQuincena')->find($trabajador->id); *//* $users = User::with('podcasts')->get(); */

        $trabajadorId = $trabajador->id;

        return $dataTable->with('trabajadorId', $trabajadorId)->render('trabajadors.show', compact('trabajador'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajador $trabajador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrabajadorRequest $request, Trabajador $trabajador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajador $trabajador)
    {
        //
    }
}
