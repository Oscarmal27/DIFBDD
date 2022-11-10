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

Route::get('/', function () {return view('index'); });

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/', function () {return view('admin.index'); });
    Route::get('/usuarios', [App\Http\Controllers\Admin\UsuariosController::class,'index']);
    Route::get('/despensas', [App\Http\Controllers\Admin\DespensasController::class,'index'] );


    Route::resource('despensas',App\Http\Controllers\Admin\DespensasController::class);
    Route::resource('usuarios',App\Http\Controllers\Admin\UsuariosController::class);

});