<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        ->addColumn('role', function($query){
            return $query->roles->map(function($rol) {
                return '<span class="badge bg-success">' . htmlspecialchars($rol->name) . ' </span>';
            })->implode('');
        })
        ->addColumn('action', function($query){
                $buttons = '';

                if(auth()->user()->can('view-user')){
                    $buttons .= '<a class="btn btn-info btn-sm" title="Ver Información" href="'.route('users.show',$query->id).'"> <i class="fa fa-eye"></i></a>';
                }

                if(auth()->user()->can('edit-user')){
                    $buttons .= '<a class="btn btn-warning btn-sm" title="Editar Información" href="'.route('users.edit',$query->id).'"> <i class="fa fa-pen-to-square"></i></a>';
                }

                if(auth()->user()->can('delete-user')){
                    $buttons .= '<button class="btn btn-danger btn-sm" title="Eliminar" data-argid="'.$query->id.'" onclick="openModalDelete(\''.$query->id.'\')"> <i class="fa fa-trash"></i></button>';
                }

                return '<div class="btn-group" role="group" aria-label="Opciones">'.$buttons.'</div>';
            })
        ->addColumn('ubicacion_fisica_name', function($query){
            return $query->ubicacionFisica ? $query->ubicacionFisica->ubicacion_fisica : 'Sin ubicación';
        })
        ->filterColumn('ubicacion_fisica_name', function($query, $keyword) {
            $query->where('ubicacion_fisicas.ubicacion_fisica', 'like', "%$keyword%");
        })
        ->rawColumns(['action', 'role'])
        ->setRowId('id');
}

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
{
    $query = $model->newQuery()
        ->select('users.*')
        ->leftJoin('ubicacion_fisicas', 'users.ubicacion_fisica_id', '=', 'ubicacion_fisicas.id');

    // Búsqueda global
    if ($this->request->has('search') && !empty($this->request->input('search.value'))) {
        $searchValue = $this->request->input('search.value');
        $query->where(function($query) use ($searchValue) {
            $query->where('users.name', 'like', "%{$searchValue}%")
                    ->orWhere('users.email', 'like', "%{$searchValue}%")
                    ->orWhere('users.cedula', 'like', "%{$searchValue}%")
                    ->orWhere('users.telefono', 'like', "%{$searchValue}%")
                    ->orWhere('ubicacion_fisicas.ubicacion_fisica', 'like', "%{$searchValue}%");
        });
    }

    // Búsqueda individual por columna
    if ($this->request->has('columns')) {
        foreach ($this->request->input('columns') as $column) {
            if (!empty($column['search']['value'])) {
                $searchValue = $column['search']['value'];
                if ($column['data'] === 'ubicacion_fisica_name') {
                    $query->where('ubicacion_fisicas.ubicacion_fisica', 'like', "%{$searchValue}%");
                }
            }
        }
    }

    

    return $query;
}

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
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
            Column::computed('action')->title('Acción')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('id')->title('ID'),
            Column::make('name')->title('Nombres'),
            Column::make('email')->title('Correo'),
            Column::make('cedula')->title('Cedula'),
            Column::make('telefono')->title('Teléfono'),
            Column::make('ubicacion_fisica_name')->title('Ubicación Física')
                    ->searchable(true)
                    ->orderable(true),
            Column::computed('role')->title('Roles')
                    ->exportable(true)
                    ->printable(true)
                    ->width(60)
                    ->addClass('text-center'),
            Column::make('created_at')->title('Creado'),
            Column::make('updated_at')->title('Actualizado'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}