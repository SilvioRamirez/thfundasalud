<?php

namespace App\DataTables;

use App\Models\PrimeraQuincena;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PrimeraQuincenaDataTable extends DataTable
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

                    if(auth()->user()->can('edit-primeraquincena')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('primeraquincena.edit',$query->id).'"> <i class="fa fa-pen-to-square"></i></a>';
                    }

                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PrimeraQuincena $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('primeraquincena-table')
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
            /* Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'), */
            Column::make('id')->title('ID'),
            Column::make('nro')->title('NRO'),
            Column::make('cedula')->title('CEDULA'),
            Column::make('sueldo_base_quincenal')->title('SUELDO BASE QUINCENAL'),
            Column::make('diferencia_de_sueldo_por_funcion_quincenal')->title('DIFERENCIA DE SUELDO POR FUNCION QUINCENAL'),
            Column::make('compensacion_por_evaluacion_quincenal')->title('COMPENSACION POR EVALUACION QUINCENAL'),
            Column::make('evaluacion_por_compensacion_2do_semestre_2024_julio_diciembre')->title('EVALUACION POR COMPENSACION 2DO SEMESTRE 2024 JULIO DICIEMBRE'),
            Column::make('escalafon_medico_quincenal')->title('ESCALAFON MEDICO QUINCENAL'),
            Column::make('escalafon_asistencial_quincenal')->title('ESCALAFON ASISTENCIAL QUINCENAL'),
            Column::make('prima_daspuns_quincenal')->title('PRIMA DASPUNS QUINCENAL'),
            Column::make('prima_por_antiguedad_quincenal')->title('PRIMA POR ANTIGUEDAD QUINCENAL'),
            Column::make('prima_por_profesionalizacion_quincenal')->title('PRIMA POR PROFESIONALIZACION QUINCENAL'),
            Column::make('dia_adicional')->title('DIA ADICIONAL'),
            Column::make('jerarquia_o_responsabilidad_empleado')->title('JERARQUIA O RESPONSABILIDAD EMPLEADO'),
            Column::make('bono_del_dia_del_nino')->title('BONO DEL DIA DEL NINO'),
            Column::make('bono_del_dia_del_padre')->title('BONO DEL DIA DEL PADRE'),
            Column::make('bono_del_dia_de_la_madre')->title('BONO DEL DIA DE LA MADRE'),
            Column::make('bono_de_uniformes')->title('BONO DE UNIFORMES'),
            Column::make('total_asignaciones')->title('TOTAL ASIGNACIONES'),
            Column::make('sso')->title('SSO'),
            Column::make('paro_forzoso')->title('PARO FORZOSO'),
            Column::make('faov')->title('FAOV'),
            Column::make('inces')->title('INCES'),
            Column::make('fondo_de_jubilacion')->title('FONDO DE JUBILACION'),
            Column::make('catset')->title('CATSET'),
            Column::make('cahorminsas')->title('CAHORMINSAS'),
            Column::make('asociacion_cooperativa_trujillo')->title('ASOCIACION COOPERATIVA TRUJILLO'),
            Column::make('asociacion_cooperativa_valera')->title('ASOCIACION COOPERATIVA VALERA'),
            Column::make('pension_por_manutencion')->title('PENSION POR MANUTENCION'),
            Column::make('sinboproenf')->title('SINBOPROENF'),
            Column::make('surbsset')->title('SURBSSET'),
            Column::make('sunepsas')->title('SUNEPSAS'),
            Column::make('impreenfermeras_valera')->title('IMPREENFERMERAS VALERA'),
            Column::make('impreenfermeras_trujillo')->title('IMPREENFERMERAS TRUJILLO'),
            Column::make('colegio_de_enfermeria_trujillo')->title('COLEGIO DE ENFERMERIA TRUJILLO'),
            Column::make('colegio_de_enfermeras_valera')->title('COLEGIO DE ENFERMERAS VALERA'),
            Column::make('sitrasalud_trujillo')->title('SITRASALUD TRUJILLO'),
            Column::make('surtrapps')->title('SURTRAPPS'),
            Column::make('fenasirtrasalud')->title('FENASIRTRASALUD'),
            Column::make('sutset')->title('SUTSET'),
            Column::make('fetratrujillo')->title('FETRATRUJILLO'),
            Column::make('fetrasalud')->title('FETRASALUD'),
            Column::make('sindicato_de_salud')->title('SINDICATO DE SALUD'),
            Column::make('total_deduciones')->title('TOTAL DEDUCIONES'),
            Column::make('total')->title('TOTAL '),
            Column::make('filtro')->title('FILTRO'),
            Column::make('ano')->title('AÑO'),
            Column::make('mes')->title('MES'),
            Column::make('created_at')->title('Creado'),
            Column::make('updated_at')->title('Actualizado'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PrimeraQuincena_' . date('YmdHis');
    }
}
