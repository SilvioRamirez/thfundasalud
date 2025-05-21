<?php

namespace App\Exports;

use App\Models\Eleccion;
use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class EleccionUsuarioExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $eleccionId;
    protected $userId;

    public function __construct($eleccionId, $userId)
    {
        $this->eleccionId = $eleccionId;
        $this->userId = $userId;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Obtener los datos usando consultas más directas
        $eleccion = Eleccion::findOrFail($this->eleccionId);
        $usuario = User::with('ubicacionFisica')->findOrFail($this->userId);
        $registros = new Collection();
        
        // Obtener registros de la tabla pivote para este usuario y elección
        $registros_pivot = DB::table('eleccion_participants')
            ->where('eleccion_id', $this->eleccionId)
            ->where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Construir la colección de datos
        foreach ($registros_pivot as $pivot) {
            $trabajador = Trabajador::find($pivot->trabajador_id);
            
            if ($trabajador) {
                $registros->push([
                    'cedula' => $trabajador->cedula,
                    'nombre' => $trabajador->nombre,
                    'cargo' => $trabajador->cargo,
                    'dependencia' => $trabajador->dependencia,
                    'registrado_por' => $usuario->name,
                    'ubicacion' => $usuario->ubicacion_fisica_name ?? 'No asignada',
                    'fecha_registro' => $pivot->created_at
                ]);
            }
        }
        
        return $registros;
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
        $usuario = User::findOrFail($this->userId);
        return 'Registros - ' . $usuario->name;
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la fila de encabezado
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DDDDDD']]],
        ];
    }
} 