<?php

namespace App\Http\Controllers;

use App\Models\UbicacionFisica;
use App\Http\Requests\StoreUbicacionFisicaRequest;
use App\Http\Requests\UpdateUbicacionFisicaRequest;
use App\DataTables\UbicacionFisicasDataTable;
class UbicacionFisicaController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-ubicacion-fisica|create-ubicacion-fisica|edit-ubicacion-fisica|delete-ubicacion-fisica', ['only' => ['index','show']]);
        $this->middleware('permission:create-ubicacion-fisica', ['only' => ['create','store']]);
        $this->middleware('permission:edit-ubicacion-fisica', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-ubicacion-fisica', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(UbicacionFisicasDataTable $dataTable)
    {
        return $dataTable->render('ubicacion_fisicas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ubicacion_fisicas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUbicacionFisicaRequest $request)
    {
        UbicacionFisica::create($request->all());
        return redirect()->route('ubicacion_fisicas.index')
                ->withSuccess('Nuevo registro agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UbicacionFisica $ubicacionFisica)
    {
        return view('ubicacion_fisicas.show', [
            'ubicacionFisica' => $ubicacionFisica
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UbicacionFisica $ubicacionFisica)
    {
        return view('ubicacion_fisicas.edit', [
            'ubicacionFisica' => $ubicacionFisica
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUbicacionFisicaRequest $request, UbicacionFisica $ubicacionFisica)
    {
        $ubicacionFisica->update($request->all());
        return redirect()->route('ubicacion_fisicas.index')
                ->withSuccess('Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UbicacionFisica $ubicacionFisica)
    {
        $ubicacionFisica->delete();
        return response()->json([
            'message' => 'Ubicación Física Eliminada Correctamente.',
            'status' => 'success'
        ]);
    }
}
