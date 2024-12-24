<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('change-username/{id}', [UserController::class, 'changeUsername']);
Route::get('get-username/{id}', [UserController::class, 'getUsernameById']);
Route::get('get-all-usernames', [UserController::class, 'getAllUsernames']);
Route::post('create-account', [UserController::class, 'createAccount']);
Route::post('login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
});

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware([EnsureFrontendRequestsAreStateful::class])->group(function () {
    // Your routes here
});
