<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\FinancialRecordController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return redirect()->route('membros.index');
});
Route::resource('membros', MembroController::class);
Route::get('/membros/{membro}/edit', [MembroController::class, 'edit'])->name('membros.edit');
Route::put('/membros/{membro}', [MembroController::class, 'update'])->name('membros.update');
Route::resource('financial', FinancialRecordController::class);

// Rota específica para editar
Route::get('financial/{financialRecord}/edit', [FinancialRecordController::class, 'edit'])->name('financial.edit');

// Rota específica para atualizar
Route::put('financial/{financialRecord}', [FinancialRecordController::class, 'update'])->name('financial.update');

// Outras rotas (se necessário)
Route::resource('financial', FinancialRecordController::class)->except(['edit', 'update']);

Route::put('financial/{financialRecord}', [FinancialRecordController::class, 'update'])->name('financial.update');
