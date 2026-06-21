<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfissionalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/explorar', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('profissionais.index');

Route::middleware('auth')->group(function () {
    Route::get('/onboarding', [ProfissionalController::class, 'onboarding'])->name('onboarding');
    Route::post('/onboarding', [ProfissionalController::class, 'salvarHabilidades'])->name('onboarding.salvar');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
