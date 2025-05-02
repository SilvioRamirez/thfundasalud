@extends('layouts.app')

@section('title', content: 'Elecciones')

@section('content_header')
    <h1 class="text-center">Administración de Elecciones</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-eleccion')
            <div class="float-start">
                <a href="{{ route('eleccions.create') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> {{ __('Agregar Nueva Eleccion') }}</a>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('eleccions.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-eleccion')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>


@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>

function openModalDelete(id){
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta elección se eliminara definitivamente de la base de datos",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
            var urlDelete = 'api/eleccionDelete/'+`${id}`;
            axios.post(urlDelete).then(response => {
                let status = response.status;
                let message = response.statusText;
                console.log(response.data);

                var tabla = $('#eleccions-table').DataTable();
                tabla.ajax.reload();

            }).catch(error => {                  
                if(error.response){
                    console.log(error.response.data.errors)
                }
            });
            Swal.fire({
                title: "¡Eliminado!",
                text: "La elección ha sido eliminada.",
                icon: "success"
            });
            
        }
    });
}



</script>


@endpush
