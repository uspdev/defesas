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

Route::get('/','AgendamentoController@index');
Route::resource('agendamentos','AgendamentoController');

// rotas para pdfs
Route::get('/documento_zero/{agendamento}','PdfController@documento_zero');

// rotas para login/logout
Route::get('/login', 'LoginController@redirectToProvider');
Route::get('/callback', 'LoginController@handleProviderCallback');
Route::get('/logout', 'LoginController@logout');
