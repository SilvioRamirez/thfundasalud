<?php

namespace App\DataTables;

use App\Models\FeDeVida;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeDeVidasDataTable extends DataTable
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

                   /*  if(auth()->user()->can('view-fe-de-vida')){
                        $buttons .= '<a class="btn btn-info btn-sm" title="Ver Información" href="'.route('fe_de_vidas.show', ['fe_de_vida' => $query->id]).'"> <i class="fa fa-eye"></i></a>';
                    }

                    if(auth()->user()->can('edit-fe-de-vida')){
                        $buttons .= '<a class="btn btn-primary btn-sm" title="Editar Información" href="'.route('fe_de_vidas.edit', ['fe_de_vida' => $query->id]).'"> <i class="fa fa-pen-to-square"></i></a>';
                    }

                    if(auth()->user()->can('delete-fe-de-vida')){
                        $buttons .= '<button class="btn btn-danger btn-sm" title="Eliminar" data-argid="'.$query->id.'" onclick="openModalDelete(\''.$query->id.'\')"> <i class="fa fa-trash"></i></button>';
                    } */
                    
                    return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';

                })
                ->addColumn('image_url', function ($query) {
                    return $query->image_url ? '<a href="' . $query->image_url . '" target="_blank" class=""><img src="' . $query->image_url . '" class="img-fluid m-1" style="width: 50px; height: 50px;"> </a>' : '';
                })
            
            ->rawColumns(['action', 'image_url'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FeDeVida $model): QueryBuilder
    {
        return $model->newQuery()
            ->select([
                'fe_de_vidas.*'
            ])
            ->with([
                'trabajador:id,cedula,nombre,cargo,codigo_rac', 
                'municipio:id,municipio', 
                'parroquia:id,parroquia', 
                'ubicacion_fisica:id,ubicacion_fisica', 
                'jefe_inmediato:id,nombre',
                'registered_by:id,name'
            ]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('fe_de_vidas-table')
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
        $columns = [];

        $columns[] = Column::computed('action')->title('Acción')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center no-search');
        
        $columns[] = Column::make('id')->title('ID');
        $columns[] = Column::make('ubicacion_fisica.ubicacion_fisica')->title('Ubicación Física');
        $columns[] = Column::make('trabajador.cedula')->title('Cédula');
        $columns[] = Column::make('trabajador.nombre')->title('Nombres y Apellidos');
        $columns[] = Column::make('trabajador.cargo')->title('Cargo');
        $columns[] = Column::make('trabajador.codigo_rac')->title('Código de Nomina');
        $columns[] = Column::make('municipio.municipio')->title('Municipio');
        $columns[] = Column::make('parroquia.parroquia')->title('Parroquia');
        $columns[] = Column::make('ubicacion_fisica_funcion')->title('Ubicación donde Cumple sus Funciones');
        $columns[] = Column::make('jefe_inmediato.nombre')->title('Jefe Inmediato');
        $columns[] = Column::make('image_url')->title('Imagen');
        $columns[] = Column::make('observaciones')->title('Observaciones');

        
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Fe de Vidas_' . date('YmdHis');
    }
} 