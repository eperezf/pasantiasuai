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
    return view('welcome');
});

Route::resource('/empresas', 'EmpresaController');

Route::resource('/users', 'UserController');

Route::get('/login', function(){
	return view('login');
});

Route::post('/login', 'LoginController@authenticate')->name('login');

Route::get('/inscripcion/0', 'PasantiaController@paso0View')->name('inscripcion.0.view');
Route::post('/inscripcion/0/post','PasantiaController@paso0Control')->name('inscripcion.0.post');
Route::get('/inscripcion/1', 'PasantiaController@paso1View')->name('inscripcion.1.view');
Route::post('/inscripcion/1/post','PasantiaController@paso1Control')->name('inscripcion.1.post');
Route::get('/inscripcion/2', 'PasantiaController@paso2View')->name('inscripcion.2.view');
Route::post('/inscripcion/2/post','PasantiaController@paso2Control')->name('inscripcion.2.post');
