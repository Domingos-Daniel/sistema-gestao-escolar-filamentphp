<?php

use App\Http\Controllers\RelatorioAcademicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/boletim/{estudante_id}', [RelatorioAcademicoController::class, 'boletim'])->middleware('auth');

use App\Http\Controllers\RelatorioFinanceiroController;

Route::get('/relatorios/resumo-anual/{ano_letivo_id}', [RelatorioFinanceiroController::class, 'resumoAnual'])->middleware('auth');