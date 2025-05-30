<?php

namespace App\Http\Controllers;

use App\DataTables\SolicitudsDataTable;
use App\DataTables\SolicitudsAdminDataTable;
use App\Models\Solicitud;
use App\Models\TipoSolicitud;
use App\Models\SolicitudDocumento;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SolicitudController extends Controller
{
    /**
     * Instantiate a new SolicitudController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-solicitud|create-solicitud|edit-solicitud|delete-solicitud', ['only' => ['index','show']]);
        $this->middleware('permission:create-solicitud', ['only' => ['create','store']]);
        $this->middleware('permission:edit-solicitud', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-solicitud', ['only' => ['destroy']]);
        $this->middleware('permission:view-admin-solicitud', ['only' => ['adminIndex']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SolicitudsDataTable $dataTable)
    {
        return $dataTable->render('solicitudes.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function adminIndex(SolicitudsAdminDataTable $dataTable)
    {
        return $dataTable->render('solicitudes.admin-index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tiposSolicitud = TipoSolicitud::activo()->get();
        
        return view('solicitudes.create', compact('tiposSolicitud'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tipo_solicitud_id' => 'required|exists:tipos_solicitud,id',
            'descripcion' => 'required|string',
            'documentos.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);

        $solicitud = Solicitud::create([
            'user_id' => auth()->id(),
            'tipo_solicitud_id' => $request->tipo_solicitud_id,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente'
        ]);

        // Manejar archivos subidos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $archivo) {
                $nombreOriginal = $archivo->getClientOriginalName();
                $nombreArchivo = Str::uuid() . '.' . $archivo->getClientOriginalExtension();
                $rutaArchivo = $archivo->storeAs('solicitudes/' . $solicitud->id, $nombreArchivo, 'public');

                SolicitudDocumento::create([
                    'solicitud_id' => $solicitud->id,
                    'nombre_original' => $nombreOriginal,
                    'nombre_archivo' => $nombreArchivo,
                    'ruta_archivo' => $rutaArchivo,
                    'tipo_mime' => $archivo->getMimeType(),
                    'tamano' => $archivo->getSize()
                ]);
            }
        }

        return redirect()->route('solicitudes.index')
                ->withSuccess('Solicitud creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($solicitude): View
    {
        $solicitud = Solicitud::findOrFail($solicitude);
        $solicitud->load(['usuario', 'tipoSolicitud', 'documentos']);
        
        return view('solicitudes.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($solicitude): View
    {
        $solicitud = Solicitud::findOrFail($solicitude);
        $tiposSolicitud = TipoSolicitud::activo()->get();
        $solicitud->load(['documentos']);
        
        return view('solicitudes.edit', compact('solicitud', 'tiposSolicitud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $solicitude): RedirectResponse
    {
        $solicitud = Solicitud::findOrFail($solicitude);
        
        $request->validate([
            'tipo_solicitud_id' => 'required|exists:tipos_solicitud,id',
            'descripcion' => 'required|string',
            'estado' => 'required|in:pendiente,en_proceso,aprobada,rechazada',
            'observaciones' => 'nullable|string',
            'documentos.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);

        $solicitud->update([
            'tipo_solicitud_id' => $request->tipo_solicitud_id,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'observaciones' => $request->observaciones,
            'fecha_respuesta' => in_array($request->estado, ['aprobada', 'rechazada']) ? now() : null
        ]);

        // Manejar nuevos archivos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $archivo) {
                $nombreOriginal = $archivo->getClientOriginalName();
                $nombreArchivo = Str::uuid() . '.' . $archivo->getClientOriginalExtension();
                $rutaArchivo = $archivo->storeAs('solicitudes/' . $solicitud->id, $nombreArchivo, 'public');

                SolicitudDocumento::create([
                    'solicitud_id' => $solicitud->id,
                    'nombre_original' => $nombreOriginal,
                    'nombre_archivo' => $nombreArchivo,
                    'ruta_archivo' => $rutaArchivo,
                    'tipo_mime' => $archivo->getMimeType(),
                    'tamano' => $archivo->getSize()
                ]);
            }
        }
        
        return redirect()->back()
                ->withSuccess('Solicitud actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($solicitude): RedirectResponse
    {
        $solicitud = Solicitud::findOrFail($solicitude);
        
        // Eliminar archivos físicos
        foreach ($solicitud->documentos as $documento) {
            Storage::disk('public')->delete($documento->ruta_archivo);
        }

        $solicitud->delete();
        
        return redirect()->route('solicitudes.index')
                ->withSuccess('Solicitud eliminada exitosamente.');
    }

    /**
     * Eliminar un documento específico
     */
    public function eliminarDocumento(SolicitudDocumento $documento): RedirectResponse
    {
        Storage::disk('public')->delete($documento->ruta_archivo);
        $documento->delete();

        return redirect()->back()
                ->withSuccess('Documento eliminado exitosamente.');
    }

    /**
     * Descargar un documento
     */
    public function descargarDocumento(SolicitudDocumento $documento)
    {
        if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
            abort(404, 'Archivo no encontrado');
        }

        return Storage::disk('public')->download($documento->ruta_archivo, $documento->nombre_original);
    }
}
