<?php

namespace App\Http\Controllers;

use App\Models\Eleccion;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\DB;

class EleccionParticipacionController extends Controller
{

    public function index()
    {
        $elecciones = Eleccion::where('status', 'activo')->get();
        return view('participants.index', compact('elecciones'));
    }

    public function mostrarFormulario(Request $request, $eleccionId)
    {
        if ($eleccionId) {
            $eleccion = Eleccion::findOrFail($eleccionId);
            if ($eleccion->status == 'activo') {
                return view('participants.formulario', compact('eleccion'));
            } else {
                return redirect()->back()->with('error', 'No se encontró la elección');
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró la elección');
        }
    }

    public function registerParticipacion(Request $request, $eleccionId)
    {
        $validated = $request->validate([
            'cedula' => 'required|string|max:15'
        ]);

        $eleccion = Eleccion::findOrFail($eleccionId);
        
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

        // Validar elección activa
        if ($eleccion->status != 'activo') {
            return back()->withErrors(['Elección no está activa']);
        }

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
        if ($eleccion->participants()->where('trabajador_id', $trabajador->id)->exists()) {
            return back()->withErrors(['Ya participó en esta elección']);
        }

        // Registrar participación con el usuario que realiza el registro
        $eleccion->participants()->attach($trabajador->id, [
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'La participación de ' . $trabajador->nombre . ' ha sido registrada exitosamente');
    }

    public function estadisticas($eleccionId)
    {
        $eleccion = Eleccion::findOrFail($eleccionId);
        $participantes = $eleccion->participants;
        
        // Inicializar variables para evitar "undefined variable"
        $todos_trabajadores = 0;
        $trabajadores_participantes = 0;
        $trabajadores_no_participantes = 0;
        $mes_nombre = 'No disponible';
        $ano_reciente = 'No disponible';
        $ids_trabajadores_recientes = collect([]);
        
        // Obtener el año y mes más reciente de la tabla trabajadores
        $ultimo_registro = Trabajador::selectRaw('ano, mes')
                            ->orderBy('ano', 'desc')
                            ->orderBy('mes', 'desc')
                            ->first();
        
        // Si encontramos un registro, usamos ese año y mes para filtrar
        if ($ultimo_registro) {
            $ano_reciente = $ultimo_registro->ano;
            $mes_reciente = $ultimo_registro->mes;
            
            // Obtener solo los trabajadores del mes más reciente
            $todos_trabajadores = Trabajador::where('ano', $ano_reciente)
                                 ->where('mes', $mes_reciente)
                                 ->count();
                                 
            // Verificamos cuántos trabajadores del mes más reciente participaron
            $ids_trabajadores_recientes = $participantes->pluck('id');

            
                                        
            $trabajadores_participantes = $participantes->whereIn('id', $ids_trabajadores_recientes)->count();

            $trabajadores_no_participantes = $todos_trabajadores - $trabajadores_participantes;
            
            // Para mostrar en la sección de depuración
            $mes_nombre = $this->obtenerNombreMes($mes_reciente);
        } else {
            // Si no hay registros, usamos los valores originales
            /* $todos_trabajadores = Trabajador::count();
            $trabajadores_participantes = $participantes->count();
            $trabajadores_no_participantes = $todos_trabajadores - $trabajadores_participantes; */
        }
        
        $chart_options_registros = [
            'chart_title' => 'Registros de Participantes',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\User',
            'relationship_name' => 'ubicacionFisica',
            'group_by_field' => 'ubicacion_fisica',
            'chart_color' => '0, 128, 255',
        ];

        $chart_registros = new LaravelChart($chart_options_registros);
        
        // Gráfico de registros por usuario - Muestra cuántos participantes ha registrado cada usuario
        $registros_por_usuario = DB::table('eleccion_participants')
                               ->where('eleccion_id', $eleccionId)
                               ->select('user_id', DB::raw('count(*) as total'))
                               ->groupBy('user_id')
                               ->get();
                               
        // Obtenemos los nombres de los usuarios para usarlos como etiquetas en el gráfico
        $labels_usuarios = [];
        $usuarios_data = []; // Array para almacenar datos completos de usuarios
        
        foreach ($registros_por_usuario as $registro) {
            // Cargamos el usuario con su relación de ubicación física
            $user = \App\Models\User::with('ubicacionFisica')->find($registro->user_id);
            $nombre_usuario = $user ? $user->name : "Usuario #".$registro->user_id;
            $labels_usuarios[$nombre_usuario] = $registro->total;
            
            // Guardamos los datos completos para la tabla
            $usuarios_data[] = [
                'id' => $registro->user_id,
                'nombre' => $nombre_usuario,
                'cantidad' => $registro->total,
                'ubicacion' => $user ? ($user->ubicacion_fisica_name ?? 'No asignada') : 'Usuario no encontrado'
            ];
        }
        
        $chart_options_usuarios = [
            'chart_title' => 'Cantidad de Registros por Usuario',
            'chart_type' => 'bar',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'id',
            'chart_color' => '255, 99, 132',
            'labels' => $labels_usuarios
        ];
        
        $chart_usuarios = new LaravelChart($chart_options_usuarios);
        
        // Pasamos todas las variables a la vista, asegurándonos de que todos_trabajadores esté definida
        $viewData = [
            'eleccion' => $eleccion,
            'participantes' => $participantes,
            'trabajadores_participantes' => $trabajadores_participantes,
            'trabajadores_no_participantes' => $trabajadores_no_participantes,
            'mes_nombre' => $mes_nombre,
            'ano_reciente' => $ano_reciente,
            'todos_trabajadores' => $todos_trabajadores,
            'chart_registros' => $chart_registros,
            'chart_usuarios' => $chart_usuarios,
            'usuarios_data' => $usuarios_data // Añadimos los datos completos de usuarios
        ];
        
        return view('participants.estadisticas', $viewData);
    }
    
    /**
     * Convierte el número de mes a nombre
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

    /**
     * Muestra los registros específicos que ha realizado un usuario en una elección
     */
    public function verRegistrosUsuario($eleccionId, $userId)
    {
        // Obtener la elección
        $eleccion = Eleccion::findOrFail($eleccionId);
        
        // Obtener el usuario
        $usuario = \App\Models\User::with('ubicacionFisica')->findOrFail($userId);
        
        // Obtener los registros de este usuario para esta elección
        $registros = DB::table('eleccion_participants')
                    ->where('eleccion_id', $eleccionId)
                    ->where('user_id', $userId)
                    ->join('trabajadors', 'eleccion_participants.trabajador_id', '=', 'trabajadors.id')
                    ->select(
                        'eleccion_participants.id',
                        'eleccion_participants.created_at as fecha_registro',
                        'trabajadors.nombre',
                        'trabajadors.cedula',
                        'trabajadors.cargo',
                        'trabajadors.dependencia'
                    )
                    ->orderBy('eleccion_participants.created_at', 'desc')
                    ->get();
        
        return view('participants.registros_usuario', compact('eleccion', 'usuario', 'registros'));
    }
}
