<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfissionalController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// 1. Tela Inicial (Pública)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. Modo Visitante (Público - Sem middleware de auth para qualquer um ver o mapa)
Route::get('/explorar', [ProfissionalController::class, 'index'])->name('profissionais.index');

Route::patch('/dashboard', [ProfissionalController::class, 'salvarOnboarding'])->name('dashboard.atualizar');


//  ROTAS PROTEGIDAS (Apenas usuários logados)

Route::middleware('auth')->group(function () {

    // Dashboard Interna
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Passo a Passo do Onboarding (Habilidades e Localização)
    Route::get('/onboarding', [ProfissionalController::class, 'onboarding'])->name('onboarding');
    Route::post('/onboarding', [ProfissionalController::class, 'salvarOnboarding'])->name('onboarding.salvar');

    // Perfil do Usuário (Nativo do Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat/{id?}', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/{id}', [ChatController::class, 'enviar'])->name('chat.enviar');
});

require __DIR__ . '/auth.php';
