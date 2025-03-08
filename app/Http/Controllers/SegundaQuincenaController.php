<?php

namespace App\Http\Controllers;

use App\DataTables\SegundaQuincenaDataTable;
use App\Models\SegundaQuincena;
use App\Http\Requests\StoreSegundaQuincenaRequest;
use App\Http\Requests\UpdateSegundaQuincenaRequest;

class SegundaQuincenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SegundaQuincenaDataTable $dataTable)
    {
        return $dataTable->render('segundaquincena.index');
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
    public function store(StoreSegundaQuincenaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SegundaQuincena $segundaQuincena)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SegundaQuincena $segundaQuincena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSegundaQuincenaRequest $request, SegundaQuincena $segundaQuincena)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SegundaQuincena $segundaQuincena)
    {
        //
    }
}
