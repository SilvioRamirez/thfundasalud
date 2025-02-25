@extends('layouts.app')

@section('content_header')
    <h1 class="text-center">Administración de Productos</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-product')
            <div class="float-start">
                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> {{ __('Agregar Nuevo Producto') }}</a>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-product')
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
            text: "Este producto se eliminara definitivamente ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
            }).then((result) => {
            if (result.isConfirmed) {
                var urlDelete = 'api/productDelete/'+`${id}`;
                axios.post(urlDelete).then(response => {
                    let status = response.status;
                    let message = response.statusText;
                    console.log(response.data);

                    var tabla = $('#products-table').DataTable();
                    tabla.ajax.reload();

                }).catch(error => {                  
                    if(error.response){
                        console.log(error.response.data.errors)
                    }
                });
                Swal.fire({
                    title: "¡Eliminado!",
                    text: "El producto ha sido eliminado.",
                    icon: "success"
                });
                
            }
        });
    }

</script>
@endpush