<?php

namespace App\DataTables;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SettingsDataTable extends DataTable
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

                    if(auth()->user()->can('edit-setting')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('settings.edit',$query->id).'"> <i class="fa fa-pen-to-square"></i></a>';
                    }

                    if(auth()->user()->can('delete-setting')){
                        $buttons .= '<button class="btn btn-danger btn-sm" title="Eliminar" data-argid="'.$query->id.'" onclick="openModalDelete(\''.$query->id.'\')"> <i class="fa fa-trash"></i></button>';
                    }

                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Setting $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('settings-table')
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
                        /*  Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'), */
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
            Column::computed('action')->title('Opciones')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('id')->title('ID'),
            Column::make('key')->title('Clave'),
            Column::make('value')->title('Valor'),
            Column::make('type')->title('Tipo'),
            Column::make('group')->title('Grupo'),
            Column::make('name')->title('Nombre'),
            Column::make('description')->title('Descripción'),
            Column::make('created_at')->title('Fecha de Creación'),
            Column::make('updated_at')->title('Fecha de Actualización'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Settings_' . date('YmdHis');
    }
}
