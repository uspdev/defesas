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

// rotas para login/logout
Route::get('/','indexController@index')->name('index');
Route::get('login','LoginController@redirectToProvider')->name('login');
Route::get('callback', 'LoginController@handleProviderCallback');
Route::get('logout','LoginController@logout')->name('logout');

// rotas de Agendamento de Defesa
Route::resource('agendamentos','AgendamentoController');

// rotas de Banca das Defesas
Route::get('/agendamentos/{agendamento}/bancas/create','BancaController@create');
Route::get('/agendamentos/{agendamento}/bancas/{banca}/edit','BancaController@edit');
Route::patch('/agendamentos/{agendamento}/bancas/{banca}','BancaController@update');
Route::post('/agendamentos/{agendamento}/bancas','BancaController@store');
Route::delete('/agendamentos/{agendamento}/bancas/{banca}','BancaController@destroy');

// rotas para pdfs
Route::get('/documento_zero/{agendamento}','PdfController@documento_zero');
Route::get('/placa/{agendamento}','PdfController@placa');
Route::get('/etiqueta/{agendamento}','PdfController@etiqueta');
Route::get('/titulares/{agendamento}','PdfController@titulares');
Route::get('/suplentes/{agendamento}','PdfController@suplentes');
Route::get('/declaracao/{agendamento}','PdfController@declaracao');
Route::get('/recibos/{agendamento}','PdfController@recibos');

