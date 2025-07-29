<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\UbicacionFisica;
use App\Models\Municipio;
use App\Models\FeDeVida;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\DataTables\FeDeVidasDataTable;
use App\DataTables\FeDeVidasGeneralDataTable;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class FeDeVidaController extends Controller
{
    /**
     * Instantiate a new TipoSolicitudController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-fe-de-vida|create-fe-de-vida|edit-fe-de-vida|delete-fe-de-vida', ['only' => ['index','show']]);
        $this->middleware('permission:create-fe-de-vida', ['only' => ['create','store']]);
        $this->middleware('permission:edit-fe-de-vida', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-fe-de-vida', ['only' => ['destroy']]);
        $this->middleware('permission:general-fe-de-vida', ['only' => ['indexGeneral']]);
    }

    public function check()
    {
        return view('fe_de_vidas.check');
    }

    public function checkCedula(Request $request)
    {

        $validated = $request->validate([
            'cedula' => 'required|string|max:15'
        ]);
        
        // Obtener el año y mes más reciente de la tabla trabajadores
        $ultimo_registro = Trabajador::selectRaw('ano, mes')
                            ->orderBy('ano', 'desc')
                            ->orderBy('mes', 'desc')
                            ->first();
        
        if (!$ultimo_registro) {
            return back()->withErrors(['No hay registros de trabajadores en el sistema']);
        }
        
        $ano_reciente = $ultimo_registro->ano;
        $mes_reciente = $ultimo_registro->mes;
        
        // Buscar el trabajador que coincida con la cédula y que pertenezca al mes y año más reciente
        $trabajador = Trabajador::where('cedula', $validated['cedula'])
                              ->where('ano', $ano_reciente)
                              ->where('mes', $mes_reciente)
                              ->first();

        // Validar existencia de empleado en el mes actual
        if (!$trabajador) {
            // Verificamos si existe el trabajador en general pero no en el periodo actual
            $trabajador_existe = Trabajador::where('cedula', $validated['cedula'])->exists();
            
            if ($trabajador_existe) {
                // El trabajador existe pero no en el periodo actual
                $mes_nombre = $this->obtenerNombreMes($mes_reciente);
                return back()->withErrors(["La cédula {$validated['cedula']} no pertenece al periodo actual ({$mes_nombre} {$ano_reciente})"]);
            } else {
                // El trabajador no existe en ningún periodo
                return back()->withErrors(['Cédula no registrada en el sistema']);
            }
        }

        // Evitar duplicados
        if ($trabajador->fe_de_vida()->exists()) {
            return back()->withErrors(['Este trabajador ya tiene un registro de fe de vida.']);
        }

        
        //$jefes_inmediatos = JefeInmediato::all();

        //return view('fe_de_vidas.create', compact('trabajador', 'municipios', 'ubicacion_fisicas'));

        return redirect()->route('fe_de_vidas.create', $trabajador);
    }

    public function fetchJefeInmediato(Request $request, $cedula)
    {
        $data['trabajador'] = Trabajador::where("cedula", $cedula)->first();
        return response()->json($data['trabajador']);
    }

    public function index(FeDeVidasDataTable $dataTable)
    {
        return $dataTable->render('fe_de_vidas.index');
    }

    public function indexGeneral(FeDeVidasGeneralDataTable $dataTable)
    {
        return $dataTable->render('fe_de_vidas.general');
    }

    public function create(Trabajador $trabajador)
    {
        $municipios = Municipio::where('estado_id', 20)->get();
        $ubicacion_fisicas = UbicacionFisica::all();

        return view('fe_de_vidas.create', compact('trabajador', 'municipios', 'ubicacion_fisicas'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'trabajador_id' => 'required',
            'municipio_id' => 'required',
            'ubicacion_fisica_id' => 'required',
            'ubicacion_fisica_funcion' => 'required',
            'jefe_inmediato_id' => 'required',
            'observaciones' => 'nullable|string|max:255',
            'image_url' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        // Handle file upload
        $fileName = null;
        if ($request->hasFile('image_url')) {
            // Eliminar archivo anterior si existe
            if ($request->file('image_url') && Storage::exists($request->file('image_url'))) {
                Storage::delete($request->file('image_url'));
            }

            $archivo = $request->file('image_url');
            $extension = $archivo->getClientOriginalExtension();
            $nombre = Str::random(10) . '_' . $archivo->getClientOriginalName();
            $ruta = public_path() . '/storage/fe_de_vidas/' . $nombre;

            // Verificar si es una imagen para procesarla
            $extensionesImagen = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array(strtolower($extension), $extensionesImagen)) {
                // Procesar imagen: redimensionar
                Image::read($archivo)
                    ->scaleDown(height: 1000)
                    ->save($ruta);
            } else {
                // Para documentos (PDF, DOC, DOCX): mover directamente sin procesamiento
                $archivo->move(public_path() . '/storage/fe_de_vidas/', $nombre);
            }

            // Guardar ruta del archivo
            $fileName = '/storage/fe_de_vidas/'. $nombre;
        }

        $fe_de_vida = new FeDeVida();
        $fe_de_vida->trabajador_id = $request->trabajador_id;
        $fe_de_vida->municipio_id = $request->municipio_id;
        $fe_de_vida->parroquia_id = $request->parroquia_id;
        $fe_de_vida->ubicacion_fisica_id = $request->ubicacion_fisica_id;
        $fe_de_vida->ubicacion_fisica_funcion = $request->ubicacion_fisica_funcion;
        $fe_de_vida->jefe_inmediato_id = $request->jefe_inmediato_id;
        $fe_de_vida->image_url = $fileName;
        $fe_de_vida->registered_by = Auth::user()->id;
        $fe_de_vida->observaciones = $request->observaciones;
        $fe_de_vida->save();

        return redirect()->route('fe_de_vidas.check')->with('success', 'Fe de Vida registrada correctamente.');
    }

    public function viewFeDeVida($fe_de_vida)
    {
        $fe_de_vida = FeDeVida::findOrFail($fe_de_vida)->load('trabajador', 'municipio', 'parroquia', 'ubicacion_fisica', 'jefe_inmediato');

        $fe_de_vida->toJson();

        return response()->json($fe_de_vida);
    }

    public function confirmFeDeVida($fe_de_vida)
    {
        $fe_de_vida = FeDeVida::findOrFail($fe_de_vida);

        $fe_de_vida->status = 'Confirmado';
        $fe_de_vida->save();

        return response()->json($fe_de_vida);
    }

    /**
     * Obtiene el nombre del mes basado en el número
     */
    private function obtenerNombreMes($numero_mes)
    {
        $meses = [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];
        
        return $meses[$numero_mes] ?? 'Desconocido';
    }
}
