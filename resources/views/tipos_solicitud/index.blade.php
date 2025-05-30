@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Administración de Solicitudes</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-solicitud')
            <div class="float-start">
                <a href="{{ route('solicitudes.create') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> {{ __('Nueva Solicitud') }}</a>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-solicitud')
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
            text: "Esta solicitud se eliminará definitivamente junto con todos sus documentos",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                var urlDelete = 'api/solicitudDelete/'+`${id}`;
                axios.post(urlDelete).then(response => {
                    let status = response.status;
                    let message = response.statusText;
                    console.log(response.data);

                    var tabla = $('#solicitudes-table').DataTable();
                    tabla.ajax.reload();

                }).catch(error => {                  
                    if(error.response){
                        console.log(error.response.data.errors)
                    }
                });
                Swal.fire({
                    title: "¡Eliminado!",
                    text: "La solicitud ha sido eliminada.",
                    icon: "success"
                });
                
            }
        });
    }

</script>
@endpush 