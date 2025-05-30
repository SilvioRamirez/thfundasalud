<?php

namespace App\DataTables;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SolicitudsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){

                    $buttons = '';

                    if(auth()->user()->can('view-solicitud')){
                        $buttons .= '<a class="btn btn-info btn-sm" title="Ver Información" href="'.route('solicitudes.show', ['solicitude' => $query->id]).'"> <i class="fa fa-eye"></i></a>';
                    }

                    if(auth()->user()->can('edit-solicitud')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('solicitudes.edit', ['solicitude' => $query->id]).'"> <i class="fa fa-pen-to-square"></i></a>';
                    }

                    if(auth()->user()->can('delete-solicitud')){
                        $buttons .= '<button class="btn btn-danger btn-sm" title="Eliminar" data-argid="'.$query->id.'" onclick="openModalDelete(\''.$query->id.'\')"> <i class="fa fa-trash"></i></button>';
                    }

                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
            ->addColumn('estado_badge', function($query){
                $badges = [
                    'pendiente' => '<span class="badge badge-warning">Pendiente</span>',
                    'en_proceso' => '<span class="badge badge-info">En Proceso</span>',
                    'aprobada' => '<span class="badge badge-success">Aprobada</span>',
                    'rechazada' => '<span class="badge badge-danger">Rechazada</span>'
                ];
                return $badges[$query->estado] ?? '<span class="badge badge-secondary">'.$query->estado.'</span>';
            })
            ->addColumn('usuario_nombre', function($query){
                return $query->usuario ? $query->usuario->name : 'N/A';
            })
            ->addColumn('tipo_solicitud_nombre', function($query){
                return $query->tipoSolicitud ? $query->tipoSolicitud->nombre : 'N/A';
            })
            ->rawColumns(['action', 'estado_badge'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Solicitud $model): QueryBuilder
    {
        return $model->newQuery()
                    ->with(['usuario', 'tipoSolicitud'])
                    ->where('user_id', auth()->id());
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('solicitudes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->lengthMenu([10, 25, 50, 100, 500, 1000])
                    ->layout([
                        'top' => [ 'pageLength', 'buttons', 'search' ],
                        'topStart' => null,
                        'topEnd' => null,
                        'bottomStart' => 'info',
                        'bottomEnd' => 'paging'
                    ])
                    ->orderBy(1, 'desc')
                    ->language([
                        'url' => url('storage/js/datatables/Spanish.json')
                    ])
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('id')->title('ID'),
            Column::computed('usuario_nombre')->title('Usuario'),
            Column::computed('tipo_solicitud_nombre')->title('Tipo de Solicitud'),
            Column::make('descripcion')->title('Descripción'),
            Column::computed('estado_badge')
                    ->title('Estado')
                    ->exportable(false)
                    ->printable(false)
                    ->addClass('text-center'),
            Column::make('created_at')->title('Creado'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Solicitudes_' . date('YmdHis');
    }
} 