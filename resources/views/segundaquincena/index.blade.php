@extends('layouts.app')

@section('title', content: 'Segunda Quincena')

@section('content_header')
    <h1 class="text-center">Administración de Segunda Quincena</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        @can('create-segundaquincena')
            <div class="float-start">
                <button type="button" class="btn btn-light btn-sm" title="Carga Masiva de Segunda Quincena" onclick="openModalCargaMasivaSegundaQuincena()"><i class="fa fa-file-import"></i> Carga Masiva de Segunda Quincena</button>
            </div>
        @endcan
        <div class="float-end">
            <a href="{{ route('segundaquincena.index') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-segundaquincena')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>

{{-- Modal Cambiar Estatus del Lente --}}
<div class="modal fade" id="ModalCargaMasivaSegundaQuincena" tabindex="-1" aria-labelledby="ModalCargaMasivaSegundaQuincenaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="ModalCargaMasivaSegundaQuincenaLabel"><i class="fa fa-file-import"></i> Carga Masiva de Segunda Quincena</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-info">
                    <p class="text-justify">Para la carga masiva de la Segunda Quincena el archivo debe estar en formato Excel y contener las columnas Año y Mes como se muestra en el siguiente ejemplo: <strong>segunda_2025-1.xlsx</strong> Desde <a href="{{ asset('storage/file/segunda_2025-2.xlsx') }}" download class="alert-link">Aquí</a>, puedes descargar un archivo base de ejemplo.</p>
                </div>

                <form id="segundaquincenaFormUpload" action="{{ route('segundaquincena.import') }}" method="POST" enctype="multipart/form-data">
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

    function openModalCargaMasivaSegundaQuincena(){

        cleanProgressBar()

        const btnSubmitData = document.getElementById('btnSubmitData');
        btnSubmitData.disabled = false;
        
        bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCargaMasivaSegundaQuincena')).show();

    }

    const formulario = document.getElementById('segundaquincenaFormUpload').addEventListener('submit', function(event) {
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
                /* formulario.reset(); // Limpia el formulario al cargar la página */

                Swal.fire({
                    title: "¡Éxito!",
                    text: response.data.message,
                    icon: "success"
                });

                //Reseteamos la tabla luego de una respuesta exitosa
                var tabla = $('#segundaquincena-table').DataTable();
                tabla.ajax.reload();

                //Ocultamos el modal
                bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCargaMasivaSegundaQuincena')).hide();

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