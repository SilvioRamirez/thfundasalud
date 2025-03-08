<?php

namespace App\Imports;

use App\Models\SegundaQuincena;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Hash;

class SegundaQuincenaImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, WithCustomCsvSettings
{
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'use_read_cache' => true, // Usar caché de lectura
        ];
    }

    public function batchSize(): int
    {
        return 1000; // Inserta 1000 registros en una sola consulta
    }

    public function chunkSize(): int
    {
        return 1000; // Procesa 1000 filas a la vez
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SegundaQuincena([
            'nro' => $row['nro'] ?? null,
            'cedula' => $row['cedula'] ?? null,
            'sueldo_base_quincenal' => $row['sueldo_base_quincenal'] ?? null,
            'diferencia_de_sueldo_por_funcion_quincenal' => $row['diferencia_de_sueldo_por_funcion_quincenal'] ?? null,
            'compensacion_por_evaluacion_quincenal' => $row['compensacion_por_evaluacion_quincenal'] ?? null,
            'evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre' => $row['evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre'] ?? null,
            'escalafon_medico_quincenal' => $row['escalafon_medico_quincenal'] ?? null,
            'escalafon_asistencial_quincenal' => $row['escalafon_asistencial_quincenal'] ?? null,
            'prima_daspuns_quincenal' => $row['prima_daspuns_quincenal'] ?? null,
            'prima_por_antiguedad_quincenal' => $row['prima_por_antiguedad_quincenal'] ?? null,
            'prima_por_profesionalizacion_quincenal' => $row['prima_por_profesionalizacion_quincenal'] ?? null,
            'dia_adicional' => $row['dia_adicional'] ?? null,
            'bono_nocturno_por_guardia' => $row['bono_nocturno_por_guardia'] ?? null,
            'bono_nocturno_fijo' => $row['bono_nocturno_fijo'] ?? null,
            'domingo_y_feriados_por_guardia' => $row['domingo_y_feriados_por_guardia'] ?? null,
            'bono_vacacional' => $row['bono_vacacional'] ?? null,
            'prima_por_hijos' => $row['prima_por_hijos'] ?? null,
            'jerarquia_o_responsabilidad_empleado' => $row['jerarquia_o_responsabilidad_empleado'] ?? null,
            'bono_del_dia_del_nino' => $row['bono_del_dia_del_nino'] ?? null,
            'bono_del_dia_del_padre' => $row['bono_del_dia_del_padre'] ?? null,
            'bono_del_dia_de_la_madre' => $row['bono_del_dia_de_la_madre'] ?? null,
            'bono_de_uniformes' => $row['bono_de_uniformes'] ?? null,
            'total_asignaciones' => $row['total_asignaciones'] ?? null,
            'catset' => $row['catset'] ?? null,
            'cahorminsas' => $row['cahorminsas'] ?? null,
            'asociacion_cooperativa_trujillo' => $row['asociacion_cooperativa_trujillo'] ?? null,
            'asociacion_cooperativa_valera' => $row['asociacion_cooperativa_valera'] ?? null,
            'pension_por_manutencion' => $row['pension_por_manutencion'] ?? null,
            'sinboproenf' => $row['sinboproenf'] ?? null,
            'surbsset' => $row['surbsset'] ?? null,
            'sunepsas' => $row['sunepsas'] ?? null,
            'impreenfermeras_valera' => $row['impreenfermeras_valera'] ?? null,
            'impreenfermeras_trujillo' => $row['impreenfermeras_trujillo'] ?? null,
            'colegio_de_enfermeria_trujillo' => $row['colegio_de_enfermeria_trujillo'] ?? null,
            'colegio_de_enfermeras_valera' => $row['colegio_de_enfermeras_valera'] ?? null,
            'sitrasalud_trujillo' => $row['sitrasalud_trujillo'] ?? null,
            'surtrapps' => $row['surtrapps'] ?? null,
            'fenasirtrasalud' => $row['fenasirtrasalud'] ?? null,
            'sutset' => $row['sutset'] ?? null,
            'fetrasalud' => $row['fetrasalud'] ?? null,
            'sso' => $row['sso'] ?? null,
            'paro_forzoso' => $row['paro_forzoso'] ?? null,
            'faov' => $row['faov'] ?? null,
            'inces' => $row['inces'] ?? null,
            'fondo_de_jubilacion' => $row['fondo_de_jubilacion'] ?? null,
            'total_deduciones' => $row['total_deduciones'] ?? null,
            'total' => $row['total'] ?? null,
            'filtro' => $row['filtro'] ?? null,
            'mes' => $row['mes'] ?? null,
            'ano' => $row['ano'] ?? null,
            'created_at'        => now(),         // Asignar fecha de creación
            'updated_at'        => now(),         // Asignar fecha de actualización
        ]);
    }
}
