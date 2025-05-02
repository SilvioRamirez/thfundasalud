<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Carbon\Carbon;
class Eleccion extends Model
{
    /** @use HasFactory<\Database\Factories\EleccionFactory> */
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'status',
    ];

    public function participants()
    {
        return $this->belongsToMany(Trabajador::class, 'eleccion_participants')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:m:s');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d h:m:s');
    }
    
    public function getFechaInicioAttribute()
    {
        if (isset($this->attributes['fecha_inicio'])) {
            // Para el input datetime-local mantenemos el formato necesario
            if (request()->is('*/create') || request()->is('*/edit/*') || request()->is('*/*/edit')) {
                return Carbon::parse($this->attributes['fecha_inicio'])->format('Y-m-d\TH:i');
            }
            // Para mostrar la información usamos formato Y-m-d H:i (formato 24 horas)
            return Carbon::parse($this->attributes['fecha_inicio'])->format('Y-m-d H:i');
        }
        return null;
    }

    public function getFechaFinAttribute()
    {
        if (isset($this->attributes['fecha_fin'])) {
            // Para el input datetime-local mantenemos el formato necesario
            if (request()->is('*/create') || request()->is('*/edit/*') || request()->is('*/*/edit')) {
                return Carbon::parse($this->attributes['fecha_fin'])->format('Y-m-d\TH:i');
            }
            // Para mostrar la información usamos formato Y-m-d H:i (formato 24 horas)
            return Carbon::parse($this->attributes['fecha_fin'])->format('Y-m-d H:i');
        }
        return null;
    }

    public function isActive()
    {
        return $this->status === 'activo';
    }
}
