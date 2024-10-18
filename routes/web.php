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
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\ApprovalStatusDefesaController;

// rotas para login/logout
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/anteriores',[indexController::class, 'exibirDefesasAnteriores'])->name('exibirDefesasAnteriores');

// rotas de Agendamento de Defesa
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('docentes',DocenteController::class);
Route::resource('bancas', BancaController::class);
Route::resource('files', FileController::class)->only(['store', 'show', 'destroy']);

// rotas para biblioteca
Route::get('/teses',[BibliotecaController::class, 'index']);
Route::patch('/teses/{agendamento}/publish',[BibliotecaController::class, 'publish']);
Route::get('/teses/publicadas',[BibliotecaController::class, 'published']);

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

Route::get('/pendencia_sala_virtual', [AgendamentoController::class, 'pendencia']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');

#Api para devolução de dados do aluno
Route::get('info', [AgendamentoController::class, 'info'])->name('pedidos.info');

Route::get('job_email_prof', [AgendamentoController::class, 'job_email_prof']);
