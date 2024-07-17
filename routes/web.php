<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembroController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return redirect()->route('membros.index');
});
Route::resource('membros', MembroController::class);
Route::get('/membros/{membro}/edit', [MembroController::class, 'edit'])->name('membros.edit');
Route::put('/membros/{membro}', [MembroController::class, 'update'])->name('membros.update');
