<?php

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


/* Valida que para usar todas estas rutas el usuario este autenticado */
Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/activitylog', [ActivityLogController::class, 'index'])->name('activitylog.index');

    Route::post('api/userDelete/{user}',   [UserController::class, 'destroy']);
    Route::post('api/roleDelete/{role}',   [RoleController::class, 'destroy']);
    Route::post('api/productDelete/{product}',   [ProductController::class, 'destroy']);

    /* Aquí se agrupan todos los controladores que queramos tener con resources */
    Route::resources([
        'roles'     => RoleController::class,
        'users'     => UserController::class,
        'products'  => ProductController::class,
    ]);

});
