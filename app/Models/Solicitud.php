<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Solicitud extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'tipo_solicitud_id',
        'descripcion',
        'estado',
        'observaciones',
        'fecha_respuesta'
    ];

    protected $casts = [
        'fecha_respuesta' => 'datetime',
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
     * Relación con el usuario que realizó la solicitud
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el tipo de solicitud
     */
    public function tipoSolicitud()
    {
        return $this->belongsTo(TipoSolicitud::class);
    }

    /**
     * Relación con los documentos
     */
    public function documentos()
    {
        return $this->hasMany(SolicitudDocumento::class);
    }

    /**
     * Accessor para el estado formateado
     */
    public function getEstadoFormateadoAttribute()
    {
        $estados = [
            'pendiente' => 'Pendiente',
            'en_proceso' => 'En Proceso',
            'aprobada' => 'Aprobada',
            'rechazada' => 'Rechazada'
        ];

        return $estados[$this->estado] ?? $this->estado;
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeConEstado($query, $estado)
    {
        return $query->where('estado', $estado);
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
