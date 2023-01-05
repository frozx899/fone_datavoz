<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//proyecto
Route:: resource('proyectos', App\Http\Controllers\ProyectoController::class);
Route::get('/codigoExistente/{id}','App\Http\Controllers\ProyectoController@codigoUsado');
Route::post('/editEstadoProy','App\Http\Controllers\ProyectoController@editEstado');
Route::get('/proyectoActivos','App\Http\Controllers\ProyectoController@proyectoActivos');

//usuario
Route:: resource('users', App\Http\Controllers\UserController::class);
Route::get('/buscarUsuario/{id}','App\Http\Controllers\UserController@buscarusuario');
Route::post('/userEdit','App\Http\Controllers\UserController@userEdit');
Route::get('/usuariosactivos','App\Http\Controllers\UserController@usuariosactivos');

//proyecto-usuarios
Route::post('/cargarusuarios','App\Http\Controllers\ProyectoUsuarioController@cargarusuarios');
Route::get('/proyectoUsuarios/{id}','App\Http\Controllers\ProyectoUsuarioController@proyectoUsuarios');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
