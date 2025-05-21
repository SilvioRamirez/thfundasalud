<?php

namespace App\Exports;

use App\Models\Eleccion;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class EleccionExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $eleccionId;

    public function __construct($eleccionId)
    {
        $this->eleccionId = $eleccionId;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Obtener los datos directamente de la base de datos usando Eloquent más básico
        $eleccion = Eleccion::findOrFail($this->eleccionId);
        $participantes = new Collection();
        
        // Obtener los registros de la tabla pivote
        $registros_pivot = DB::table('eleccion_participants')
            ->where('eleccion_id', $this->eleccionId)
            ->get();
            
        foreach ($registros_pivot as $pivot) {
            $trabajador = Trabajador::find($pivot->trabajador_id);
            $user = User::with('ubicacionFisica')->find($pivot->user_id);
            
            if ($trabajador && $user) {
                $participantes->push([
                    'cedula' => $trabajador->cedula,
                    'nombre' => $trabajador->nombre,
                    'cargo' => $trabajador->cargo,
                    'dependencia' => $trabajador->dependencia,
                    'registrado_por' => $user->name,
                    'ubicacion' => $user->ubicacion_fisica_name ?? 'No asignada',
                    'fecha_registro' => $pivot->created_at
                ]);
            }
        }
        
        // Ordenar por fecha de registro descendente
        return $participantes->sortByDesc('fecha_registro')->values();
    }
    
    public function headings(): array
    {
        return [
            'Cédula',
            'Nombre',
            'Cargo',
            'Dependencia',
            'Registrado Por',
            'Ubicación',
            'Fecha de Registro'
        ];
    }
    
    public function title(): string
    {
        $eleccion = Eleccion::findOrFail($this->eleccionId);
        return 'Participantes - ' . $eleccion->nombre;
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la fila de encabezado
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DDDDDD']]],
        ];
    }
} 