<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeDeVida extends Model
{
    protected $fillable = [
        'trabajador_id',
        'ubicacion_fisica_id',
        'municipio_id',
        'parroquia_id',
        'ubicacion_fisica_funcion',
        'jefe_inmediato_id',
        'registered_by',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function ubicacion_fisica()
    {
        return $this->belongsTo(UbicacionFisica::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class);
    }

    public function jefe_inmediato()
    {
        return $this->belongsTo(Trabajador::class, 'jefe_inmediato_id');
    }

    public function registered_by()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
