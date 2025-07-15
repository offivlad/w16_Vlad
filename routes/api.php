<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\TelegramValidationController;

Route::post('/auth/telegram', [AuthController::class, 'telegram']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Все админские роуты с проверкой middleware 'admin'
Route::middleware('admin')->group(function () {
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/users/create', [AdminController::class, 'createUser']);
    Route::post('/admin/users/{id}', [AdminController::class, 'updateBalance']);
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser']);
});

Route::get('/test-header', function (Request $request) {
    return response()->json([
        'all_headers' => $request->headers->all(),
    ]);
});



Route::post('/auth/telegram-validate', [TelegramValidationController::class, 'validateInitData']);
