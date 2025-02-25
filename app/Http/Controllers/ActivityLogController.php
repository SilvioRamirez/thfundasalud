<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Spatie\Activitylog\Models\Activity;
use App\DataTables\ActivityLogDataTable;

class ActivityLogController extends Controller
{
    /**
     * Verifica los permisos de los usuarios en el controlador
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:list-activitylog|create-activitylog|edit-activitylog|delete-activitylog', ['only' => ['index','show']]);
        $this->middleware('permission:create-activitylog', ['only' => ['create','store']]);
        $this->middleware('permission:edit-activitylog',   ['only' => ['edit','update']]);
        $this->middleware('permission:delete-activitylog', ['only' => ['delete','destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(ActivityLogDataTable $dataTable)
    {
        return $dataTable->render('activitylog.index');
    }

    /**
     * Remove all the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_all(): RedirectResponse
    {
        if (Activity::truncate()){
            return redirect()->route('logs.index')
                            ->with('success','La tabla ha sido vaciada correctamente.');
        }else{
            return redirect()->route('logs.index')
                            ->with('error','Ha ocurrido un error.');
        }
    }
}
