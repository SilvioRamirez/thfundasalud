<?php

namespace App\DataTables;

use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TrabajadorsDataTable extends DataTable
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

                    /* if(auth()->user()->can('edit-trabajador')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('trabajadors.edit',$query->id).'"> <i class="fa fa-pen-to-square"></i></a>';
                    } */

                    if(auth()->user()->can('view-trabajador')){
                        $buttons .= '<a class="btn btn-info btn-sm" title="Ver Información del Trabajador" href="'.route('trabajadors.show',$query->id).'"> <i class="fa fa-eye"></i></a>';
                    }

                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Trabajador $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('trabajadors-table')
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
            Column::computed('action')->title('ACCIONES')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('id'),
            Column::make('nro')->title('NRO'),
            Column::make('cedula')->title('CEDULA'),
            Column::make('nombre')->title('NOMBRE'),
            Column::make('codigo_rac')->title('CODIGO RAC'),
            Column::make('cargo')->title('CARGO'),
            Column::make('dependencia')->title('DEPENDENCIA'),
            Column::make('fecha_ingreso')->title('FECHA DE INGRESO'),
            Column::make('anos_anteriores')->title('AÑOS ANTERIORES'),
            Column::make('banco')->title('BANCO'),
            Column::make('cuenta')->title('CUENTA'),
            Column::make('nomina')->title('NOMINA'),
            Column::make('ano')->title('AÑO'),
            Column::make('mes')->title('MES'),
            Column::make('created_at')->title('CREADO'),
            Column::make('updated_at')->title('ACTUALIZADO'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Trabajadors_' . date('YmdHis');
    }
}
