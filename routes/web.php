<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\EmailController;
#use App\Http\Controllers\DevController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\BibliotecaController;
#use App\Http\Controllers\ApprovalStatusDefesaController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\JanusController;

// rotas para login/logout
Route::get('/', [IndexController::class, 'index'])->name('index');

// rotas de Agendamento de Defesa
Route::get('agendamentos/search', [AgendamentoController::class, 'search']);
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('bancas', BancaController::class);
Route::resource('files', FileController::class)->only(['store', 'show', 'destroy']);

/* Route::post('janus', [JanusController::class, 'store']); */

// rotas para biblioteca
Route::get('/teses',[BibliotecaController::class, 'index']);
Route::patch('/teses/{agendamento}/publish',[BibliotecaController::class, 'publish']);
Route::get('/teses/publicadas',[BibliotecaController::class, 'published']);

// rotas para pdfs
Route::get('/agendamentos/{agendamento}/{tipo}',[PdfController::class, 'gerarDocumentosGerais']);
Route::get('/declaracao/{agendamento}/{codpes}',[PdfController::class, 'declaracao']);
Route::get('/statement/{agendamento}/{codpes}',[PdfController::class, 'statement']);
Route::get('/suplente/{agendamento}/{codpes}',[PdfController::class, 'suplente']);
Route::get('/titular/{agendamento}/{codpes}',[PdfController::class, 'titular']);
Route::get('/invite/{agendamento}/{codpes}',[PdfController::class, 'invite']);
Route::post('/agendamentos/{agendamento}/bancas/{codpes}/{tipo}',[PdfController::class, 'gerarRecibosAuxilios']);

// rotas para configs
Route::get('/configs',[ConfigController::class, 'edit']);
Route::post('/configs',[ConfigController::class, 'store']);

// rotas para visualização de e-mails
Route::post('/agendamentos/{agendamento}/bancas/{codpes}/recibos/exibir_recibo_externo',[EmailController::class, 'exibirReciboExterno']);
Route::post('/agendamentos/{agendamento}/bancas/{codpes}/recibos/exibir_email_docente',[EmailController::class, 'exibirEmailDocente']);

//Rota para envio de e-mails
Route::post('agendamentos/recibo_externo/{agendamento}/{codpes}', [AgendamentoController::class,'enviarEmailReciboExterno']);
Route::post('agendamentos/pro_labore/{agendamento}/{docente}', [AgendamentoController::class,'enviarEmailProLabore']);
Route::post('agendamentos/passagem/{agendamento}/{codpes}', [AgendamentoController::class,'enviarEmailPassagem']);
Route::post('agendamentos/dados_prof_externo/{agendamento}/{codpes}', [AgendamentoController::class,'enviarEmailDeConfirmacaoDadosProfExterno']);

Route::get('/pendencia_sala_virtual', [AgendamentoController::class, 'pendencia']);

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');

#Api para devolução de dados do aluno
#Route::get('info', [AgendamentoController::class, 'info'])->name('pedidos.info');

Route::get('job_email_prof', [AgendamentoController::class, 'job_email_prof']);

#comunicacao
Route::get('/comunicacao', [CommunicationController::class, 'index']);
Route::get('/comunicacao/{agendamento}', [CommunicationController::class, 'show']);

Route::get('/emails/banca/{agendamento}', [AgendamentoController::class, 'emailsBanca']);

Route::get('/docentes', [DocenteController::class, 'index']);
Route::get('/docentes/search', [DocenteController::class, 'search']);
Route::get('/docentes/{codpes}', [DocenteController::class, 'participacao']);

