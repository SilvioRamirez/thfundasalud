<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\DataTables\SettingsDataTable;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SettingsDataTable $dataTable)
    {
        return $dataTable->render('settings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::create($request->all());
        return redirect()->route('settings.index')
            ->withSuccess('Nuevo registro agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());
        return redirect()->route('settings.index')
            ->withSuccess('Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return response()->json([
            'message' => 'Configuración Eliminada Correctamente.',
            'status' => 'success'
        ]);
    }
}
