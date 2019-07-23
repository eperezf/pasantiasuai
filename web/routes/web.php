<?php

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

Route::get('/', function () {
	return view('index');
})->middleware('auth');

Route::resource('/empresas', 'EmpresaController')->middleware('auth');

Route::resource('/admin/estadisticas', 'GraficasController')->middleware('auth');
Route::resource('/admin/importarlista', 'ListadoController')->middleware('auth');
Route::resource('/admin/listadoInscripcion', 'ListadoInscripcionController')->middleware('auth');
Route::get('/admin/tablaInscripciones', 'ListadoInscripcionController@export')->name( 'tablaInscripciones.export')->middleware('auth');

Route::resource('/perfil', 'PerfilController')->middleware('auth');


Route::get('/login', function(){
	return view('login');
});

Route::post('/login', 'LoginController@authenticate')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::get('/inscripcion/0', 'PasantiaController@paso0View')->name('inscripcion.0.view')->middleware('auth');
Route::post('/inscripcion/0/post','PasantiaController@paso0Control')->name('inscripcion.0.post')->middleware('auth');
Route::get('/inscripcion/1', 'PasantiaController@paso1View')->name('inscripcion.1.view')->middleware('auth');
Route::post('/inscripcion/1/post','PasantiaController@paso1Control')->name('inscripcion.1.post')->middleware('auth');
Route::get('/inscripcion/2', 'PasantiaController@paso2View')->name('inscripcion.2.view')->middleware('auth');
Route::post('/inscripcion/2/post','PasantiaController@paso2Control')->name('inscripcion.2.post')->middleware('auth');
Route::get('/inscripcion/3', 'PasantiaController@paso3View')->name('inscripcion.3.view')->middleware('auth');
Route::post('/inscripcion/3/post','PasantiaController@paso3Control')->name('inscripcion.3.post')->middleware('auth');
Route::get('/inscripcion/4', 'PasantiaController@paso4View')->name('inscripcion.4.view')->middleware('auth');
Route::post('/inscripcion/4/post','PasantiaController@paso4Control')->name('inscripcion.4.post')->middleware('auth');
Route::get('/inscripcion/resumen', 'PasantiaController@resumenView')->name('inscripcion.resumen')->middleware('auth');

Route::get('/confirmarTutor/{id}', 'PasantiaController@confirmarTutor')->name('confTutor');

Route::delete('/inscripcion/destroy/{id}','PasantiaController@destroy')->name('inscripcion.destroy')->middleware('auth');
