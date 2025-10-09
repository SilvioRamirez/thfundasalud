@extends('layouts.app')

@section('title', content: 'Configuraciones')

@section('content_header')
    <h1 class="text-center">Administración de Configuraciones</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-user')
            <div class="float-start">
                <a href="{{ route('settings.create') }}" class="btn btn-light btn-sm"><i class="fa fa-user-plus"></i> {{ __('Agregar Nueva Configuración') }}</a>
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
        text: "Esta configuración se eliminara definitivamente ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            var urlDelete = 'api/settingDelete/'+`${id}`;
            axios.post(urlDelete).then(response => {
                let status = response.status;
                let message = response.data.message; // Obtenemos el mensaje de la respuesta
                console.log(response.data);

                var tabla = $('#settings-table').DataTable();
                tabla.ajax.reload();

                Swal.fire({
                    title: "¡Eliminado!",
                    text: message, // Usamos el mensaje de la respuesta
                    icon: "success"
                });
            }).catch(error => {                  
                if(error.response){
                    console.log(error.response.data.errors);
                    Swal.fire({
                        title: "Error",
                        text: error.response.data.message || "Ha ocurrido un error al eliminar la configuración",
                        html: error.response.data.details,
                        icon: "error"
                    });
                }
            });
        }
    });
}



</script>


@endpush
