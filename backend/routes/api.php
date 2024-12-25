<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('create-account', [UserController::class, 'createAccount']);
Route::post('login', [UserController::class, 'login']);
Route::get('get-all-users', [UserController::class, 'getAllUsers']); // Debugging route

// Authenticated routes (JWT protected)
Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('change-username/{id}', [UserController::class, 'changeUsername']);
    Route::get('get-username/{id}', [UserController::class, 'getUsernameById']);
});

