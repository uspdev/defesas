<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\FileController;

// rotas para login/logout
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/anteriores',[indexController::class, 'exibirDefesasAnteriores'])->name('exibirDefesasAnteriores');

// rotas de Agendamento de Defesa
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('docentes',DocenteController::class);
Route::resource('bancas', BancaController::class);
Route::resource('files', FileController::class);

// rotas para pdfs
Route::get('/agendamentos/{agendamento}/{tipo}',[PdfController::class, 'gerarDocumentosGerais']);
Route::get('/agendamentos/{agendamento}/bancas/{banca}/{tipo}',[PdfController::class, 'gerarDocumentosIndividuais']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/{tipo}',[PdfController::class, 'gerarRecibosAuxilios']);

// rotas para configs
Route::get('/configs',[ConfigController::class, 'edit']);
Route::post('/configs',[ConfigController::class, 'store']);

// rotas para visualização de e-mails
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/exibir_recibo_externo',[EmailController::class, 'exibirReciboExterno']);
Route::post('/agendamentos/{agendamento}/bancas/{banca}/recibos/exibir_email_docente',[EmailController::class, 'exibirEmailDocente']);

//Rota para envio de e-mails
Route::post('agendamentos/recibo_externo/{agendamento}/{docente}', [AgendamentoController::class,'enviarEmailReciboExterno']);
Route::post('agendamentos/pro_labore/{agendamento}/{docente}', [AgendamentoController::class,'enviarEmailProLabore']);
Route::post('agendamentos/passagem/{agendamento}/{banca}', [AgendamentoController::class,'enviarEmailPassagem']);
Route::post('agendamentos/dados_prof_externo/{agendamento}/{banca}', [AgendamentoController::class,'enviarEmailDeConfirmacaoDadosProfExterno']);

# Features em Desenvolvimento
Route::get('/dev/bancas_aprovadas', [DevController::class,'bancas_aprovadas']);
Route::post('/dev/codpes/{codpes}', [DevController::class,'dados_defesa_aluno']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');

#Api para devolução de dados do aluno
Route::get('info', [AgendamentoController::class, 'info'])->name('pedidos.info');
