@extends('layouts.app')

@section('title', content: 'Usuarios')

@section('content_header')
    <h1 class="text-center">Administración de Usuarios</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-user')
            <div class="float-start">
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm"><i class="fa fa-user-plus"></i> {{ __('Agregar Nuevo Usuario') }}</a>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('users.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-user')
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
        text: "Este usuario se eliminara definitivamente ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
            var urlDelete = 'api/userDelete/'+`${id}`;
            axios.post(urlDelete).then(response => {
                let status = response.status;
                let message = response.statusText;
                console.log(response.data);

                var tabla = $('#users-table').DataTable();
                tabla.ajax.reload();

            }).catch(error => {                  
                if(error.response){
                    console.log(error.response.data.errors)
                }
            });
            Swal.fire({
                title: "¡Eliminado!",
                text: "El usuario ha sido eliminado.",
                icon: "success"
            });
            
        }
    });
}



</script>


@endpush
