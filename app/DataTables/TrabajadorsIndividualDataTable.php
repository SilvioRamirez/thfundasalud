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

class TrabajadorsIndividualDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('primera_quincena', function ($trabajador) {
                //return $trabajador->primeraQuincena->pluck('mes')->implode(', ');

                $str='';
                foreach($trabajador->primeraQuincena as $primeraQuincena){
                    foreach($trabajador->segundaQuincena as $segundaQuincena){

                        if($primeraQuincena->ano == $segundaQuincena->ano && $primeraQuincena->mes == $segundaQuincena->mes){
                            /* $primeraQuincena->mes = null; */
                            $str .=
                            '<a class="btn btn-link" title="Ver Recibo" href="'.route('recibopago.pdf', [$trabajador->cedula, $primeraQuincena->ano, $primeraQuincena->mes]).'"> '.$primeraQuincena->ano.'-'.$primeraQuincena->mes.'</a>'.
                            '<br>'
                            ;
                        }

                    }
                }
                return $str;

            })
            /* ->addColumn('segunda_quincena', function ($trabajador) {
                //return $trabajador->segundaQuincena->pluck('mes')->implode(', ');

                $str='';
                foreach($trabajador->segundaQuincena as $quincena){
                    $str .=
                    '<a class="btn btn-link" title="Ver Recibo" href="'.route('trabajadors.show', $trabajador->id).'"> '.$quincena->ano.'-'.$quincena->mes.'</a>'.
                    '<br>'
                    ;
                }
                return $str;
            }) */
            ->rawColumns(['primera_quincena', 'segunda_quincena'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Trabajador $model): QueryBuilder
    {

        if($this->trabajadorId) {
            return $model->newQuery()->where('id', $this->trabajadorId);
        }

        // Si no se proporciona un ID, devolver todos los registros
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('trabajadorsindividual-table')
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
                        /* Button::make('excel'), */
                        /* Button::make('csv'), */
                        /* Button::make('pdf'), */
                        /* Button::make('print'), */
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
            /* Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'), */
            /* Column::make('id'), */
            Column::make('nombre'),
            Column::make('primera_quincena')->title('Año - Mes'),
            /* Column::make('segunda_quincena'), */
            /* Column::make('created_at')->title('Creado'),
            Column::make('updated_at')->title('Actualizado'), */
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TrabajadorsIndividual_' . date('YmdHis');
    }
}
