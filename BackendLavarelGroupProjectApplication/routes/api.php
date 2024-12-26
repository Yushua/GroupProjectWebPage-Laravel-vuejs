<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllerUnsecure;
use App\Http\Controllers\AuthController;

Route::post('/register-unsecure', [AuthControllerUnsecure::class, 'registerUnsecure']);
Route::post('/login-unsecure', [AuthControllerUnsecure::class, 'loginUnsecure']);
Route::get('/check-unsecure', [AuthControllerUnsecure::class, 'checkUnsecure']);
Route::get('/all-users-unsecure', [AuthControllerUnsecure::class, 'allUsersUnsecure']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('/all-users', [AuthController::class, 'allUsers']);
    Route::get('/profile', function (\Illuminate\Http\Request $request) {
        return response()->json(['userId' => $request->userId]);
    });
});
