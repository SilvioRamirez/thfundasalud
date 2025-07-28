<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parroquia;
use Illuminate\Http\JsonResponse;

class DropdownController extends Controller
{
    /**
    * Return parroquias list based on the selected municipio
    *
    * @return JsonResponse
    */
    public function fetchParroquia(Request $request, $municipioId)
    {
        $data['parroquias'] = Parroquia::where("municipio_id", $municipioId)
                                                    ->get(["parroquia", "id"]);
        return response()->json($data['parroquias']);
    }
}
