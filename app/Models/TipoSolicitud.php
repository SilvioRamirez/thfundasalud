<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TipoSolicitud extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'tipos_solicitud';

    protected $fillable = [
        'nombre',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Implementa el registro de Logs
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->dontSubmitEmptyLogs();
    }

    /**
     * Relación con solicitudes
     */
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    /**
     * Scope para tipos activos
     */
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function getCreatedAtAttribute()
    {
        if (!isset($this->attributes['created_at']) || !$this->attributes['created_at']) {
            return null;
        }
        return \Carbon\Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        if (!isset($this->attributes['updated_at']) || !$this->attributes['updated_at']) {
            return null;
        }
        return \Carbon\Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
    }
}
