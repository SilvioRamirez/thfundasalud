<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Trabajador extends Model
{
    /** @use HasFactory<\Database\Factories\TrabajadorFactory> */
    use HasFactory, LogsActivity;

    /**
     * Implementa el registro de Logs
     *
     * @var array<int, string>
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function primeraQuincena()
    {
        return $this->hasMany(PrimeraQuincena::class, 'cedula', 'cedula');
    }

    // Relación con SegundaQuincena
    public function segundaQuincena()
    {
        return $this->hasMany(SegundaQuincena::class, 'cedula', 'cedula');
    }

    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:m:s');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d h:m:s');
    }

    public function getFechaIngresoAttribute()
    {
        return Carbon::parse($this->attributes['fecha_ingreso'])->format('d/m/Y');
    }

    public function getAnosIngresoAttribute()
    {
        return Carbon::parse($this->attributes['fecha_ingreso'])->age;
    }

    public function getAnosApnAttribute()
    {
        try {
            // Si estamos obteniendo esto en el contexto de un recibo de pago específico
            // Usamos la fecha del recibo para el cálculo
            if (!empty($this->attributes['ano']) && !empty($this->attributes['mes'])) {
                // Convertir el mes a número con formato de dos dígitos
                $mes = str_pad($this->attributes['mes'], 2, '0', STR_PAD_LEFT);
                
                // Crear una fecha para el último día del mes del recibo
                $fecha_recibo = Carbon::createFromFormat('Y-m-d', $this->attributes['ano'] . '-' . $mes . '-01')
                                      ->endOfMonth();
                
                // Obtener la fecha de ingreso correctamente
                if (isset($this->attributes['fecha_ingreso'])) {
                    // Verificar primero si ya está en formato d/m/Y
                    if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->attributes['fecha_ingreso'])) {
                        $fecha_ingreso = Carbon::createFromFormat('d/m/Y', $this->attributes['fecha_ingreso']);
                    } else {
                        // Si no es d/m/Y, intentar parsear
                        $fecha_ingreso = Carbon::parse($this->attributes['fecha_ingreso']);
                    }
                    
                    // Registrar para debug
                    \Illuminate\Support\Facades\Log::debug('Cálculo años: ' . 
                        'Fecha ingreso: ' . $fecha_ingreso->format('Y-m-d') . 
                        ', Fecha recibo: ' . $fecha_recibo->format('Y-m-d'));
                    
                    // Cálculo manual de años (más preciso que diffInYears)
                    $anos_completos = 0;
                    if ($fecha_recibo->year > $fecha_ingreso->year) {
                        $anos_completos = $fecha_recibo->year - $fecha_ingreso->year;
                        
                        // Verificar si aún no ha llegado el mes/día del aniversario
                        if ($fecha_recibo->month < $fecha_ingreso->month || 
                            ($fecha_recibo->month == $fecha_ingreso->month && 
                             $fecha_recibo->day < $fecha_ingreso->day)) {
                            $anos_completos--;
                        }
                    }
                    
                    // Añadir años anteriores
                    $anos_anteriores = is_numeric($this->attributes['anos_anteriores']) 
                                      ? (int)$this->attributes['anos_anteriores'] 
                                      : 0;
                    
                    $total_anos = $anos_completos + $anos_anteriores;
                    \Illuminate\Support\Facades\Log::debug('Total años calculados: ' . $total_anos);
                    
                    return $total_anos;
                }
            }
            
            // Comportamiento por defecto cuando no hay contexto de recibo
            // Usar una lógica similar a la anterior, pero con la fecha actual
            if (isset($this->attributes['fecha_ingreso'])) {
                $fecha_actual = Carbon::now();
                
                if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->attributes['fecha_ingreso'])) {
                    $fecha_ingreso = Carbon::createFromFormat('d/m/Y', $this->attributes['fecha_ingreso']);
                } else {
                    $fecha_ingreso = Carbon::parse($this->attributes['fecha_ingreso']);
                }
                
                // Cálculo manual de años
                $anos_completos = 0;
                if ($fecha_actual->year > $fecha_ingreso->year) {
                    $anos_completos = $fecha_actual->year - $fecha_ingreso->year;
                    
                    // Verificar si aún no ha llegado el mes/día del aniversario
                    if ($fecha_actual->month < $fecha_ingreso->month || 
                        ($fecha_actual->month == $fecha_ingreso->month && 
                         $fecha_actual->day < $fecha_ingreso->day)) {
                        $anos_completos--;
                    }
                }
                
                // Añadir años anteriores
                $anos_anteriores = is_numeric($this->attributes['anos_anteriores']) 
                                  ? (int)$this->attributes['anos_anteriores'] 
                                  : 0;
                
                return $anos_completos + $anos_anteriores;
            }
            
            return 0;
        } catch (\Exception $e) {
            // En caso de error, registrar y devolver un valor por defecto
            \Illuminate\Support\Facades\Log::error('Error al calcular años APN: ' . $e->getMessage() . ' - Trabajador ID: ' . ($this->id ?? 'N/A'));
            return isset($this->attributes['anos_anteriores']) ? (int)$this->attributes['anos_anteriores'] : 0;
        }
    }

    public function eleccions()
    {
        return $this->belongsToMany(Eleccion::class, 'eleccion_participants')->withTimestamps();
    }
}
