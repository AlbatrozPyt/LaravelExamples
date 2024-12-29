<?php

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\UsersTypesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;


// Rotas de autenticação
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);


// Rotas autenticadas
Route::middleware([JwtMiddleware::class])->group(function () {
    // Rotas para tipos de usuario
    Route::get('user-types', [UsersTypesController::class, 'index']);
    Route::post('user-types/create', [UsersTypesController::class, 'store']);
    Route::delete('user-types/delete/{id}', [UsersTypesController::class, 'destroy']);

    // Rotas de usuario
    Route::get('users', [UsersController::class, 'index']);
    Route::put('users/update/{id}', [UsersController::class, 'update']);

    // Rotas da loja
    Route::get('stores', [StoresController::class, 'index']);
    Route::post('stores/create', [StoresController::class, 'store']);
    Route::put('stores/update/{id}', [StoresController::class, 'update']);

    // Rotas de autenticação
    Route::delete('auth/logout', [AuthController::class, 'logout']);
});
