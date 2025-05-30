<?php

namespace App\Http\Controllers;

use App\DataTables\TipoSolicitudsDataTable;
use App\Models\TipoSolicitud;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TipoSolicitudController extends Controller
{
    /**
     * Instantiate a new TipoSolicitudController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-tipo-solicitud|create-tipo-solicitud|edit-tipo-solicitud|delete-tipo-solicitud', ['only' => ['index','show']]);
        $this->middleware('permission:create-tipo-solicitud', ['only' => ['create','store']]);
        $this->middleware('permission:edit-tipo-solicitud', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tipo-solicitud', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TipoSolicitudsDataTable $dataTable)
    {
        return $dataTable->render('tipos_solicitud.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tipos_solicitud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        TipoSolicitud::create($request->all());
        
        return redirect()->route('tipos-solicitud.index')
                ->withSuccess('Tipo de solicitud creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($tipos_solicitud): View
    {
        $tipoSolicitud = TipoSolicitud::findOrFail($tipos_solicitud);
        return view('tipos_solicitud.show', [
            'tipoSolicitud' => $tipoSolicitud
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tipos_solicitud): View
    {
        $tipoSolicitud = TipoSolicitud::findOrFail($tipos_solicitud);
        return view('tipos_solicitud.edit', [
            'tipoSolicitud' => $tipoSolicitud
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tipos_solicitud): RedirectResponse
    {
        $tipoSolicitud = TipoSolicitud::findOrFail($tipos_solicitud);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean'
        ]);

        $tipoSolicitud->update($request->all());
        
        return redirect()->back()
                ->withSuccess('Tipo de solicitud actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tipos_solicitud): RedirectResponse
    {
        $tipoSolicitud = TipoSolicitud::findOrFail($tipos_solicitud);
        $tipoSolicitud->delete();
        
        return redirect()->route('tipos-solicitud.index')
                ->withSuccess('Tipo de solicitud eliminado exitosamente.');
    }
}
