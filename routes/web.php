<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DevController;

// rotas para login/logout
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/anteriores',[indexController::class, 'anteriores'])->name('anteriores');
Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

// rotas de Agendamento de Defesa
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('docentes',DocenteController::class);
Route::resource('bancas', BancaController::class);

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

// rotas para visualização de e-mails
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/reciboExterno',[EmailController::class, 'reciboExterno']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/emailDocente',[EmailController::class, 'emailDocente']);

//Rota para envio de e-mails
Route::post('agendamentos/recibo_externo/{agendamento}/{configs}/{docente}', [AgendamentoController::class,'recibo_externo']);
Route::post('agendamentos/pro_labore/{agendamento}/{docente}', [AgendamentoController::class,'pro_labore']);
Route::post('agendamentos/passagem/{agendamento}/{banca}', [AgendamentoController::class,'passagem']);
Route::post('agendamentos/dados_prof_externo/{agendamento}/{banca}', [AgendamentoController::class,'dados_prof_externo']);

# Features em Desenvolvimento
Route::get('/dev/bancas_aprovadas', [DevController::class,'bancas_aprovadas']);
Route::post('/dev/codpes/{codpes}', [DevController::class,'dados_defesa_aluno']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');
