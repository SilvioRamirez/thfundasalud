@extends('layouts.app')

@section('title', 'Trabajadores')

@section('content_header')
    <h1 class="text-center">Administración de Trabajadores</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary">
        @can('create-product')
            <div class="float-start">
                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> {{ __('Agregar Nuevo Trabajador') }}</a>
                <button type="button" class="btn btn-light btn-sm" title="Carga Masiva de Trabajadores" onclick="openModalCargaMasivaTrabajadors()"><i class="fa fa-file-import"></i> Carga Masiva de Trabajadores</button>

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

{{-- Modal Cambiar Estatus del Lente --}}
<div class="modal fade" id="ModalCargaMasivaTrabajadors" tabindex="-1" aria-labelledby="ModalCargaMasivaTrabajadorsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="ModalCargaMasivaTrabajadorsLabel"><i class="fa fa-file-import"></i> Carga Masiva de Trabajadores</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="alert alert-info">
                    <p class="text-justify">Para la carga masiva de Trabajadores el archivo debe estar en formato Excel y contener el Año y el Mes como se muestra en el siguiente ejemplo: <strong>trabajadores_2025-1.xlsx</strong> Desde <a href="{{ asset('storage/file/trabajadores_2025-1.xlsx') }}" download class="alert-link">Aquí</a>, puedes descargar un archivo base de ejemplo.</p>
                </div>

                <form id="trabajadorsFormUpload" action="{{ route('trabajadors.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="file">Selecciona un archivo de Excel:</label>
                    <input type="file" name="file" class="form-control" accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    
            </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" id="btnSubmitData"><i class="fa fa-file-import"></i> Importar Data</button>
                    </div>
                </form>
                <div id="progressBar" class="container">
                </div>
        </div>
    </div>
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

    function openModalCargaMasivaTrabajadors(){

        cleanProgressBar()

        const btnSubmitData = document.getElementById('btnSubmitData');
        btnSubmitData.disabled = false;
        
        bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCargaMasivaTrabajadors')).show();

    }

    document.getElementById('trabajadorsFormUpload').addEventListener('submit', function(event) {
        event.preventDefault();

        const btnSubmitData = document.getElementById('btnSubmitData');
        btnSubmitData.disabled = true;

        document.getElementById('progressBar').innerHTML = '<p><strong>Cargando y Procesando la Información, por favor espere...</strong></p><div class="progress mb-4" bis_skin_checked="1"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" bis_skin_checked="1"></div></div>';

        var formData = new FormData(this);
        var url = this.action; //Toma la ruta del action del form
        axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            if (response.data.success) {

                console.log(response.data.message); // Mensaje de éxito

                Swal.fire({
                    title: "¡Éxito!",
                    text: response.data.message,
                    icon: "success"
                });

                //Reseteamos la tabla luego de una respuesta exitosa
                var tabla = $('#trabajadors-table').DataTable();
                tabla.ajax.reload();

                //Ocultamos el modal
                bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCargaMasivaTrabajadors')).hide();

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error :(",
                    text: response.data.message,
                });
                console.log(response.data.message); // Mensaje de error
                cleanProgressBar()
            }
        }).catch(error => {
            if (error.response) {
                Swal.fire({
                    icon: "error",
                    title: "Error :(",
                    text: error.response.data.message,
                });
                console.log(error.response.data.message); // Mostrar mensaje de error del servidor
                cleanProgressBar()
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error :(",
                    text: 'Error de conexión',
                });
                console.log('Error de conexión'); // Error de red
                cleanProgressBar()
            }
        });
    });

    function cleanProgressBar(){
        document.getElementById('progressBar').innerHTML ='';
    }
</script>
@endpush