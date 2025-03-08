<?php

use App\Http\Controllers\ActivityLogController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('recibopago/verify/{id}/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_verify'])->name('recibopago.verify');

Route::get('test', fn () => phpinfo());

/* Valida que para usar todas estas rutas el usuario este autenticado */
Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/activitylog', [ActivityLogController::class, 'index'])->name('activitylog.index');

    Route::post('api/userDelete/{user}',        [UserController::class, 'destroy']);
    Route::post('api/roleDelete/{role}',        [RoleController::class, 'destroy']);
    Route::post('api/productDelete/{product}',  [ProductController::class, 'destroy']);

    /* Rutas para importar y exportar excel */
    Route::post('trabajadors-import', [TrabajadorExcelController::class, 'import'])->name('trabajadors.import');
    Route::post('primeraquincena-import', [PrimeraQuincenaExcelController::class, 'import'])->name('primeraquincena.import');
    Route::post('segundaquincena-import', [SegundaQuincenaExcelController::class, 'import'])->name('segundaquincena.import');

    /* Rutas Recibo de Pago */
    Route::get('recibopago/{cedula}/{ano}/{mes}', [ReciboPagoController::class, 'recibo_pago_pdf'])->name('recibopago.pdf');
    Route::get('users/recibos/{cedula}/', [UserReciboController::class, 'recibos'])->name('user.recibopago');

    /* Aquí se agrupan todos los controladores que queramos tener con resources */
    Route::resources([
        'roles'             => RoleController::class,
        'users'             => UserController::class,
        'products'          => ProductController::class,
        'trabajadors'       => TrabajadorController::class,
        'primeraquincena'   => PrimeraQuincenaController::class,
        'segundaquincena'   => SegundaQuincenaController::class,
    ]);

});
