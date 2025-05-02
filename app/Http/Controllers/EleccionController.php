<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Http\Requests\StoreEleccionRequest;
use App\Http\Requests\UpdateEleccionRequest;
use App\DataTables\EleccionsDataTable;
class EleccionController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-eleccion|create-eleccion|edit-eleccion|delete-eleccion', ['only' => ['index','show']]);
        $this->middleware('permission:create-eleccion', ['only' => ['create','store']]);
        $this->middleware('permission:edit-eleccion', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-eleccion', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(EleccionsDataTable $dataTable)
    {
        return $dataTable->render('eleccions.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eleccions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEleccionRequest $request)
    {
        Eleccion::create($request->all());
        return redirect()->route('eleccions.index')->with('success', 'Eleccion creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eleccion $eleccion)
    {
        return view('eleccions.show', compact('eleccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eleccion $eleccion)
    {
        return view('eleccions.edit', compact('eleccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEleccionRequest $request, Eleccion $eleccion)
    {
        $eleccion->update($request->all());
        return redirect()->route('eleccions.index')->with('success', 'Eleccion actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleccion $eleccion)
    {
        $eleccion->delete();
        return redirect()->route('eleccions.index')->with('success', 'Eleccion eliminada correctamente');
    }
}
