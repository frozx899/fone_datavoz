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
Route::get('/usuariosactivos/{id}','App\Http\Controllers\UserController@usuariosactivos');

//proyecto-usuarios
Route::post('/cargarusuarios','App\Http\Controllers\ProyectoUsuarioController@cargarusuarios');
Route::get('/proyectoUsuarios/{id}','App\Http\Controllers\ProyectoUsuarioController@proyectoUsuarios');

//carga de contactos
Route::post('/importCSVContactos','App\Http\Controllers\ContactoController@importCSVContactos');
Route::get('/obtenerContacto/{id}','App\Http\Controllers\ContactoController@obtenerContacto');
Route::post('/gInicioEncuesta','App\Http\Controllers\ContactoController@inicioEncuesta');
Route::post('/fEncuesta','App\Http\Controllers\ContactoController@finEncuesta');



//Incidencias
Route::resource('incidencia',App\Http\Controllers\IncidenciasController::class);
Route::get('/inciContacto/{id}','App\Http\Controllers\IncidenciasController@incidenciaContacto');
Route::post('/incidencia1','App\Http\Controllers\ContactoController@incidenciaContacto1');
Route::post('/incidencia2','App\Http\Controllers\ContactoController@incidenciaContacto2');
Route::post('/incidencia3','App\Http\Controllers\ContactoController@incidenciaContacto3');
Route::post('/incidencia4','App\Http\Controllers\ContactoController@incidenciaContacto4');
Route::post('/incidencia5','App\Http\Controllers\ContactoController@incidenciaContacto5');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
