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
                // Verificar si existen registros tanto en primera como en segunda quincena
                $existePrimeraQuincena = $trabajador->primeraQuincena()
                    ->where('ano', $trabajador->ano)
                    ->where('mes', $trabajador->mes)
                    ->exists();

                $existeSegundaQuincena = $trabajador->segundaQuincena()
                    ->where('ano', $trabajador->ano)
                    ->where('mes', $trabajador->mes)
                    ->exists();

                // Solo mostrar el botón si existen ambos registros
                if ($existePrimeraQuincena && $existeSegundaQuincena) {
                    return '<a class="btn btn-success btn-sm" title="Descargar Recibo" href="' .
                           route('recibopago.pdf', [$trabajador->cedula, $trabajador->ano, $trabajador->mes]) .
                           '"><i class="fa fa-download"></i></a>';
                }

                return ''; // No mostrar el botón si falta alguna quincena
            })
            ->rawColumns(['primera_quincena'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Trabajador $model): QueryBuilder
    {
        if($this->trabajadorId) {
            // Primero obtenemos la cédula del trabajador usando el ID
            $cedula = Trabajador::where('id', $this->trabajadorId)->value('cedula');
            // Luego filtramos por esa cédula
            return $model->newQuery()->where('cedula', $cedula);
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
                        'topStart' => 'pageLength',
                        'topEnd' => null,
                        'bottomStart' => 'info',
                        'bottomEnd' => 'paging'
                    ])
                    ->orderBy(0, 'desc')
                    ->orderBy(1, 'desc')
                    ->language([
                        'url' => url('storage/js/datatables/Spanish.json')
                    ])
                    ->buttons([
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('ano')->title('Año')->addClass('text-center'),
            Column::make('mes')->title('Mes')->addClass('text-center'),
            Column::make('primera_quincena')->title('Descargar')->addClass('text-center'),
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
