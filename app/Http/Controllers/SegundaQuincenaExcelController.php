<?php

namespace App\Http\Controllers;

use App\Models\SegundaQuincena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Imports\SegundaQuincenaImport;

class SegundaQuincenaExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:20480|file|mimes:xlsx,xls',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }

        $fileName = $request->file('file')->getClientOriginalName();

        // Eliminar la extensión .xlsx usando pathinfo
        $nombreSinExtension = pathinfo($fileName, PATHINFO_FILENAME); // "segundaquincena_2025-1"

        // Separar el nombre del archivo usando explode
        $partes = explode('_', $nombreSinExtension); // ["segundaquincena", "2025-1"]

        // Separar el año y el número usando explode nuevamente
        $anoNumero = explode('-', $partes[1]); // ["2025", "1"]

        // Asignar a variables
        $ano = $anoNumero[0]; // "2025"
        $mes = $anoNumero[1]; // "1"

        DB::transaction(function () use ($ano, $mes){
            SegundaQuincena::where('ano', $ano)
                        ->where('mes', $mes)
                        ->forceDelete();
        });

        DB::transaction(function () use ($request) {
            Excel::import(new SegundaQuincenaImport, $request->file('file'));
        });

        // Devolver una respuesta exitosa
        return response()->json([
            'success' => true,
            'message' => 'Información Cargada Correctamente',
            /* 'data' => $request->all(), */ // Opcional: devolver los datos procesados
        ], 200); // Código HTTP 200: OK

    }
}
