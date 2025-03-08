<?php

namespace App\Imports;

use App\Models\Trabajador;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Hash;

class TrabajadorsImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, WithCustomCsvSettings
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
        //dd($row);
        return new Trabajador([
            'nro'               => $row['nro'],
            'cedula'            => $row['cedula'],
            'nombre'            => $row['nombre'],
            'codigo_rac'        => $row['codigo_rac'],
            'cargo'             => $row['cargo'],
            'dependencia'       => $row['ubicacion_fisica_del_trabajador'],
            'fecha_ingreso'     => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_de_ingreso']),
            'anos_anteriores'   => $row['anos_anteriores'],
            'cuenta'            => $row['cuenta'],
            'nomina'            => $row['nomina_fijocontratado'],
            'mes'               => $row['mes'],
            'ano'               => $row['ano'],
            'created_at'        => now(),         // Asignar fecha de creación
            'updated_at'        => now(),         // Asignar fecha de actualización
        ]);
    }
}










