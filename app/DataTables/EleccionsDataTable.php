<?php

namespace App\DataTables;

use App\Models\Eleccion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EleccionsDataTable extends DataTable
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

                    if(auth()->user()->can('view-eleccion')){
                        $buttons .= '<a class="btn btn-info btn-sm" title="Ver Información" href="'.route('eleccions.show',$query->id).'"> <i class="fa fa-eye"></i></a>';
                    }

                    if(auth()->user()->can('edit-eleccion')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('eleccions.edit',$query->id).'"> <i class="fa fa-pen-to-square"></i></a>';
                    }

                    if(auth()->user()->can('delete-eleccion')){
                        $buttons .= '<button class="btn btn-danger btn-sm" title="Eliminar" data-argid="'.$query->id.'" onclick="openModalDelete(\''.$query->id.'\')"> <i class="fa fa-trash"></i></button>';
                    }

                    if(auth()->user()->can('estadisticas-eleccion')){
                        $buttons .= '<a class="btn btn-success btn-sm" title="Estadísticas" href="'.route('eleccions.estadisticas',$query->id).'"> <i class="fa fa-chart-line"></i></a>';
                    }

                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Eleccion $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('eleccions-table')
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
            Column::make('id'),
            Column::make('nombre'),
            Column::make('fecha_inicio'),
            Column::make('fecha_fin'),
            Column::make('status'),
            Column::make('created_at')->title('Fecha de Creación'),
            Column::make('updated_at')->title('Fecha de Actualización'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Eleccions_' . date('YmdHis');
    }
}
