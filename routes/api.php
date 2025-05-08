<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgendamentoController;

Route::get('/agendamentos', [AgendamentoController::class, 'index']);
