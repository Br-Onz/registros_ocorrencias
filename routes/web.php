<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;


Route::middleware(['auth'])->group(function () {
    Route::get('/home', App\Livewire\Home::class)->name('home');
    Route::get('/ocorrencia', App\Livewire\Ocorrencias::class)->name('ocorrencia');
    Route::get('/tipos', App\Livewire\Tipos::class)->name('tipos');
    /*Route::get('/gerar-pdf', [PDFController::class, 'gerarPDF'])->name('gerar-pdf');
    Route::get('/visualizar-pdf', [PDFController::class, 'visualizarPDF'])->name('visualizar-pdf');*/
});
Route::get('/', App\Livewire\Login::class)->name('login');
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
