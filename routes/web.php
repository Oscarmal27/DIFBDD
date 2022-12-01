<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return redirect("/admin"); });

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class,'index']);
    Route::get('/usuarios', [App\Http\Controllers\Admin\UsuariosController::class,'index']);
    Route::get('/despensas', [App\Http\Controllers\Admin\DespensasController::class,'index'] );
    Route::get('/beneficiarios', [App\Http\Controllers\Admin\BeneficiariosController::class,'index'] );
    Route::get('/entregas', [App\Http\Controllers\Admin\EntregasController::class,'index'] );
    Route::get('/programas', [App\Http\Controllers\Admin\ProgramasController::class,'index'] );
    Route::post('/despensas/edit', [App\Http\Controllers\Admin\DespensasController::class,'edit'] );

    Route::get('/generarPDF', [App\Http\Controllers\Admin\DespensasController::class,'generar'] );


    Route::resource('despensas',App\Http\Controllers\Admin\DespensasController::class);
    Route::resource('usuarios',App\Http\Controllers\Admin\UsuariosController::class);

    

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
