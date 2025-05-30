<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDocumento extends Model
{
    use HasFactory;

    protected $table = 'solicitud_documentos';

    protected $fillable = [
        'solicitud_id',
        'nombre_original',
        'nombre_archivo',
        'ruta_archivo',
        'tipo_mime',
        'tamano'
    ];

    /**
     * Relación con la solicitud
     */
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    /**
     * Accessor para el tamaño formateado
     */
    public function getTamanoFormateadoAttribute()
    {
        $bytes = $this->tamano;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
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
