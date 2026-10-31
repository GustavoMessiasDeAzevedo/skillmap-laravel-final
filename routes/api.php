<?php

use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']);

Route::get('/skills', [SkillController::class, 'index']);

Route::get('/usuarios', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/conversations', [ChatController::class, 'getConversationsApi']);
    Route::get('/conversations/{id}/messages', [ChatController::class, 'getMessagesApi']);
    Route::post('/messages', [ChatController::class, 'sendMessageApi']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/user/completeRegister', [UserController::class, 'completeRegister']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/usuario/skills', [UserController::class, 'mySkill']);
});
