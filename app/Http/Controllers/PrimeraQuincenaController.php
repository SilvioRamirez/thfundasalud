<?php

namespace App\Http\Controllers;

use App\DataTables\PrimeraQuincenaDataTable;
use App\Models\PrimeraQuincena;
use App\Http\Requests\StorePrimeraQuincenaRequest;
use App\Http\Requests\UpdatePrimeraQuincenaRequest;

class PrimeraQuincenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PrimeraQuincenaDataTable $dataTable)
    {
        return $dataTable->render('primeraquincena.index');
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
    public function store(StorePrimeraQuincenaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PrimeraQuincena $primeraQuincena)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrimeraQuincena $primeraQuincena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrimeraQuincenaRequest $request, PrimeraQuincena $primeraQuincena)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimeraQuincena $primeraQuincena)
    {
        //
    }
}
