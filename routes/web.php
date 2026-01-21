<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrabajadorExcelController;
use App\Http\Controllers\PrimeraQuincenaController;
use App\Http\Controllers\SegundaQuincenaController;
use App\Http\Controllers\PrimeraQuincenaExcelController;
use App\Http\Controllers\ReciboPagoController;
use App\Http\Controllers\SegundaQuincenaExcelController;
use App\Http\Controllers\UserReciboController;
use App\Http\Controllers\UbicacionFisicaController;
use App\Http\Controllers\EleccionParticipacionController;
use App\Http\Controllers\EleccionController;
use App\Http\Controllers\TipoSolicitudController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\FeDeVidaController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\UserConstanciaController;
use App\Http\Controllers\ConstanciaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReciboArcController;
use App\Http\Controllers\UserReciboArcController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;

// Login and Logout Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout',  [LoginController::class,'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

//Rutas de recuperación de contraseña
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', function () {
    return view('welcome');
});

Route::get('contactanos', function (){
    Mail::to('silvio.ramirez.m@gmail.com')->send(new ContactanosMailable());

    return 'Mensaje enviado';
    
})->name('contactanos');

Route::get('recibopago/verify/{id}/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_verify'])->name('recibopago.verify');
Route::get('constancia/verify/{id}/{cedula}/{ano}/{mes}', [ConstanciaController::class, 'constancia_verify'])->name('constancia.verify');
Route::get('recibo/arc/verify/{id}/{cedula}/{ano}', [ReciboArcController::class, 'recibo_arc_verify'])->name('recibo_arc.verify');
Route::post('arc/check/cedula', [ReciboArcController::class, 'arc_check_cedula'])->name('arc.check.cedula');

Route::get('arc/check', [ReciboArcController::class, 'arc_check'])->name('arc.check');

Route::get('test', fn () => phpinfo());

/* Valida que para usar todas estas rutas el usuario este autenticado */
Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/activitylog', [ActivityLogController::class, 'index'])->name('activitylog.index');
    
    /* Rutas para eliminar */
    Route::post('api/userDelete/{user}',        [UserController::class, 'destroy']);
    Route::post('api/roleDelete/{role}',        [RoleController::class, 'destroy']);
    Route::post('api/productDelete/{product}',  [ProductController::class, 'destroy']);
    Route::post('api/ubicacion_fisicaDelete/{ubicacion_fisica}',  [UbicacionFisicaController::class, 'destroy']);
    Route::post('api/eleccionDelete/{eleccion}',  [EleccionController::class, 'destroy']);
    Route::post('api/tipoSolicitudDelete/{tipoSolicitud}',  [TipoSolicitudController::class, 'destroy']);
    Route::post('api/solicitudDelete/{solicitud}',  [SolicitudController::class, 'destroy']);
    Route::post('api/settingDelete/{setting}',  [SettingController::class, 'destroy']);

    /* Rutas específicas para solicitudes */
    Route::delete('solicitudes/documentos/{documento}', [SolicitudController::class, 'eliminarDocumento'])->name('solicitudes.documentos.destroy');
    Route::get('solicitudes/documentos/{documento}/descargar', [SolicitudController::class, 'descargarDocumento'])->name('solicitudes.documentos.download');
    Route::get('admin-solicitudes', [SolicitudController::class, 'adminIndex'])->name('admin-solicitudes.index');

    /* Rutas para importar y exportar excel */
    Route::post('trabajadors-import', [TrabajadorExcelController::class, 'import'])->name('trabajadors.import');
    Route::post('primeraquincena-import', [PrimeraQuincenaExcelController::class, 'import'])->name('primeraquincena.import');
    Route::post('segundaquincena-import', [SegundaQuincenaExcelController::class, 'import'])->name('segundaquincena.import');

    /* Rutas Recibo de Pago */
    Route::get('recibopago/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_pdf'])->name('recibopago.pdf');
    Route::get('users/recibos/index', [UserReciboController::class, 'index'])->name('user.recibo.index');

    /* Rutas ARC */
    Route::get('recibo/arc/{cedula}/{ano}', [ReciboArcController::class, 'recibo_arc_pdf'])->name('recibo.arc.pdf');
    Route::get('users/recibos/arc/index', [UserReciboArcController::class, 'index'])->name('user.recibo.arc.index');

    /* Rutas Constancia de Trabajo */
    Route::post('constancia/{cedula}', [ConstanciaController::class, 'constancia_pdf'])->name('constancia.pdf');
    Route::get('users/constancias/index', [UserConstanciaController::class, 'index'])->name('user.constancia.index');

    Route::get('/elecciones/{eleccion}/registrar/formulario', [EleccionParticipacionController::class, 'mostrarFormulario'])
        ->name('elecciones.formulario');

    Route::post('/participacion/register/{eleccion}', [EleccionParticipacionController::class, 'registerParticipacion'])
        ->name('participacion.register');

    Route::get('/participacion', [EleccionParticipacionController::class, 'index'])->name('participacion.index');

    Route::get('/elecciones/{eleccion}/estadisticas', [EleccionParticipacionController::class, 'estadisticas'])
        ->name('eleccions.estadisticas');

    Route::get('/elecciones/{eleccionId}/registros/{userId}', [EleccionParticipacionController::class, 'verRegistrosUsuario'])
        ->name('eleccion.usuario.registros');

    /* Rutas para exportar a Excel */
    Route::get('/elecciones/{eleccionId}/excel', [EleccionParticipacionController::class, 'exportarExcelGeneral'])
        ->name('eleccion.excel.general');

    Route::get('/elecciones/{eleccionId}/usuario/{userId}/excel', [EleccionParticipacionController::class, 'exportarExcelUsuario'])
        ->name('eleccion.usuario.excel');

    Route::get('/fe_de_vidas/check', [FeDeVidaController::class, 'check'])
        ->name('fe_de_vidas.check');

    Route::post('/fe_de_vidas/check/cedula', [FeDeVidaController::class, 'checkCedula'])
        ->name('fe_de_vidas.check.cedula');

    Route::get('/fe_de_vidas/create/{trabajador}', [FeDeVidaController::class, 'create'])
        ->name('fe_de_vidas.create');

    Route::post('/fe_de_vidas', [FeDeVidaController::class, 'store'])
        ->name('fe_de_vidas.store');

    Route::get('/fe_de_vidas', [FeDeVidaController::class, 'index'])
        ->name('fe_de_vidas.index');

    Route::get('/fe_de_vidas/general', [FeDeVidaController::class, 'indexGeneral'])
        ->name('fe_de_vidas.general');

    Route::post('/fe_de_vidas/{fe_de_vida}/view', [FeDeVidaController::class, 'viewFeDeVida'])
        ->name('fe_de_vidas.view');

    Route::post('/fe_de_vidas/{fe_de_vida}/confirm', [FeDeVidaController::class, 'confirmFeDeVida'])
        ->name('fe_de_vidas.confirm');

    Route::get('api/fetch-parroquias/{municipioId}', [DropdownController::class, 'fetchParroquia'])
        ->name('fetch.parroquias');
    
    Route::get('api/fetch-jefe-inmediato/{cedula}', [FeDeVidaController::class, 'fetchJefeInmediato'])
        ->name('fetch.jefe-inmediato');

    /* Aquí se agrupan todos los controladores que queramos tener con resources */
    Route::resources([
        'roles'             => RoleController::class,
        'users'             => UserController::class,
        'products'          => ProductController::class,
        'trabajadors'       => TrabajadorController::class,
        'primeraquincena'   => PrimeraQuincenaController::class,
        'segundaquincena'   => SegundaQuincenaController::class,
        'ubicacion_fisicas' => UbicacionFisicaController::class,
        'eleccions'         => EleccionController::class,
        'tipos-solicitud'   => TipoSolicitudController::class,
        'solicitudes'       => SolicitudController::class,
        'settings'          => SettingController::class,
    ]);

});
