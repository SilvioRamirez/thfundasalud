@extends('layouts.app')

@section('title', content: 'Fe de Vidas')

@section('content_header')
    <h1 class="text-center">Administración de Fe de Vidas General</h1>
@stop

@section('content')

@include('fragment.messages')

<div class="card">
    <div class="card-header bg-primary ">
        <div class="float-end">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm">&larr; {{ __('actions.return') }}</a>
        </div>
    </div>
    @can('view-user')
        <div class="card-body">

            {{ $dataTable->table() }}

        </div>
    @endcan
</div>

{{-- Modal Fe de Vidas --}}
<div class="modal fade" id="viewFeDeVidaModal" tabindex="-1" aria-labelledby="viewFeDeVidaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="feDeVidaModalLabel"><i class="fa fa-hand-holding-medical"></i> Información de Fe de Vida</h1>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-6">
                        <p><strong>ID: </strong><span id="spanid"></span></p>
                        <p><strong>Ubicación Física: </strong><span id="spanubicacion_fisica"></span></p>
                        <p><strong>Municipio: </strong><span id="spanmunicipio"></span></p>
                        <p><strong>Parroquia: </strong><span id="spanparroquia"></span></p>
                        <p><strong>Ubicación donde Cumple sus Funciones: </strong><span id="spanubicacion_funcion"></span></p>
                        <p><strong>Nombres y Apellidos: </strong><span id="spannombres_apellidos"></span></p>
                        <p><strong>Jefe Inmediato: </strong><span id="spanjefe_inmediato"></span></p>
                        <p><strong>Observaciones: </strong><span id="spanobservaciones"></span></p>
                        <p><strong>Estatus: </strong><span id="spanstatus"></span></p>
                        <input type="hidden" id="fe_de_vida_id">
                        
                    </div>
                    <div class="col-6">
                        <div id="archivo-container">
                            <!-- Contenedor para imagen -->
                            <figure id="imagen-container" style="display: none;">
                                <img id="spanimagen" class="img-fluid img-thumbnail img-responsive img-rounded" src="" alt="">
                            </figure>
                            
                            <!-- Contenedor para documentos -->
                            <div id="documento-container" style="display: none;" class="text-center p-4 border rounded">
                                <i class="fas fa-file-pdf fa-4x text-danger mb-3" id="documento-icono"></i>
                                <h5 id="documento-nombre" class="mb-3"></h5>
                                <a id="documento-enlace" href="" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-download"></i> Descargar / Ver Archivo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnConfirmFeDeVida" style="display: none;" onclick="confirmFeDeVida()"><i class="fa fa-check mr-2"></i>Confirmar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close mr-2"></i>Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>

function confirmFeDeVida() {
            var id = document.getElementById('fe_de_vida_id').value;
            var url = '/fe_de_vidas/' + id + '/confirm';

            axios.post(url).then(response => {
                let status = response.status;
                let message = response.statusText;

                $('#fe_de_vidas-table').DataTable().ajax.reload(null, false);

                bootstrap.Modal.getOrCreateInstance(document.getElementById('viewFeDeVidaModal')).hide();

                Swal.fire({
                    title: "¡Confirmado!",
                    text: message, // Usamos el mensaje de la respuesta
                    icon: "success"
                });
            }).catch(error => {
                if (error.response) {
                    /* console.log(error.response.data.errors); */
                    Swal.fire({
                        title: "Error",
                        text: error.response.data.message ||
                            "Ha ocurrido un error al confirmar la Fe de Vida",
                        html: error.response.data.details,
                        icon: "error"
                    });
                }
            });   
        }

        function mostrarArchivo(urlArchivo) {
            // Ocultar ambos contenedores inicialmente
            document.getElementById('imagen-container').style.display = 'none';
            document.getElementById('documento-container').style.display = 'none';
            
            if (!urlArchivo) {
                return;
            }
            
            // Extraer la extensión del archivo
            const extension = urlArchivo.split('.').pop().toLowerCase();
            const extensionesImagen = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
            
            if (extensionesImagen.includes(extension)) {
                // Es una imagen
                document.getElementById('spanimagen').src = urlArchivo;
                document.getElementById('imagen-container').style.display = 'block';
            } else {
                // Es un documento
                const nombreArchivo = urlArchivo.split('/').pop();
                const icono = document.getElementById('documento-icono');
                
                // Cambiar el icono según el tipo de archivo
                icono.className = 'fa-4x mb-3';
                if (extension === 'pdf') {
                    icono.className += ' fas fa-file-pdf text-danger';
                } else if (['doc', 'docx'].includes(extension)) {
                    icono.className += ' fas fa-file-word text-primary';
                } else {
                    icono.className += ' fas fa-file text-secondary';
                }
                
                document.getElementById('documento-nombre').textContent = nombreArchivo;
                document.getElementById('documento-enlace').href = urlArchivo;
                document.getElementById('documento-container').style.display = 'block';
            }
        }

        function openModalViewFeDeVida(id) {
            var url = '/fe_de_vidas/' + id + '/view';

            axios.post(url).then(response => {
                console.log(response.data);
                let status = response.status;
                let message = response.statusText;

                bootstrap.Modal.getOrCreateInstance(document.getElementById('viewFeDeVidaModal')).show();
                
                document.getElementById('spanid').textContent = response.data.id || '';
                document.getElementById('spanubicacion_fisica').textContent = response.data.ubicacion_fisica.ubicacion_fisica || '';
                document.getElementById('spanmunicipio').textContent = response.data.municipio.municipio || '';
                document.getElementById('spanparroquia').textContent = response.data.parroquia.parroquia || '';
                document.getElementById('spanubicacion_funcion').textContent = response.data.ubicacion_fisica_funcion || '';
                document.getElementById('spannombres_apellidos').textContent = response.data.trabajador.nombre || '';
                document.getElementById('spanjefe_inmediato').textContent = response.data.jefe_inmediato.nombre || '';
                document.getElementById('spanobservaciones').textContent = response.data.observaciones || '';
                document.getElementById('spanstatus').textContent = response.data.status || '';
                document.getElementById('fe_de_vida_id').value = response.data.id || '';
                
                // Manejo del archivo (imagen o documento)
                mostrarArchivo(response.data.image_url);

                if (response.data.status === 'Confirmado') {
                    document.getElementById('btnConfirmFeDeVida').style.display = 'none';
                }

                if (response.data.status === 'Registrado') {
                    document.getElementById('btnConfirmFeDeVida').style.display = 'block';
                }

            }).catch(error => {
                if (error.response) {
                    /* console.log(error.response.data.errors) */
                }
            });
        }


</script>


@endpush
