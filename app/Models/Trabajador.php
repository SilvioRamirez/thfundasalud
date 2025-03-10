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

    public function getAnosApnAttribute()
    {
        /* return \Carbon\Carbon::parse($this->attributes['anos_anteriores'])->format('d/m/Y'); */

        return Carbon::createFromFormat('d/m/Y', $this->fecha_ingreso)->age + $this->anos_anteriores;
    }
}
