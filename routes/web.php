<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmailController;

// rotas para login/logout
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/anteriores',[indexController::class, 'anteriores'])->name('anteriores');
Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

// rotas de Agendamento de Defesa
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('docentes',DocenteController::class);

// rotas de Banca das Defesas
Route::get('/agendamentos/{agendamento}/bancas/create',[BancaController::class, 'create']);
Route::get('/agendamentos/{agendamento}/bancas/{banca}/edit',[BancaController::class, 'edit']);
Route::patch('/agendamentos/{agendamento}/bancas/{banca}',[BancaController::class, 'update']);
Route::post('/agendamentos/{agendamento}/bancas',[BancaController::class, 'store']);
Route::delete('/agendamentos/{agendamento}/bancas/{banca}',[BancaController::class, 'destroy']);

// rotas para pdfs
Route::get('/agendamentos/{agendamento}/{tipo}',[PdfController::class, 'documentosGerais']);
Route::get('/agendamentos/{agendamento}/bancas/{banca}/{tipo}',[PdfController::class, 'documentosIndividuais']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/proex',[PdfController::class, 'proex']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/proap',[PdfController::class, 'proap']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/passagem',[PdfController::class, 'passagem']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/passagemAuxilio',[PdfController::class, 'passagemAuxilio']);

// rotas para configs
Route::get('/configs',[ConfigController::class, 'edit']);
Route::post('/configs',[ConfigController::class, 'store']);

// rotas para recibos
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/reciboExterno',[EmailController::class, 'reciboExterno']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/emailDocente',[EmailController::class, 'emailDocente']);

