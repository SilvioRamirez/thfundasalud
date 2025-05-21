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
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;

// Login and Logout Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout',  [LoginController::class,'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('contactanos', function (){
    Mail::to('silvio.ramirez.m@gmail.com')->send(new ContactanosMailable());

    return 'Mensaje enviado';
    
})->name('contactanos');

Route::get('recibopago/verify/{id}/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_verify'])->name('recibopago.verify');

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


    /* Rutas para importar y exportar excel */
    Route::post('trabajadors-import', [TrabajadorExcelController::class, 'import'])->name('trabajadors.import');
    Route::post('primeraquincena-import', [PrimeraQuincenaExcelController::class, 'import'])->name('primeraquincena.import');
    Route::post('segundaquincena-import', [SegundaQuincenaExcelController::class, 'import'])->name('segundaquincena.import');

    /* Rutas Recibo de Pago */
    Route::get('recibopago/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_pdf'])->name('recibopago.pdf');
    Route::get('users/recibos/index', [UserReciboController::class, 'index'])->name('user.recibo.index');

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
    ]);

});
