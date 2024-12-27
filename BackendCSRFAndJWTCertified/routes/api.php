<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;

// Unsecured routes
Route::post('/register-unsecure', [AuthController::class, 'registerUnsecure']);
Route::post('/login-unsecure', [AuthController::class, 'loginUnsecure']);
Route::get('/check-unsecure', [AuthController::class, 'checkUnsecure']);
Route::get('/all-users-unsecure', [AuthController::class, 'allUsersUnsecure']);

// Secured routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('/all-users', [AuthController::class, 'allUsers']);
    Route::get('/profile', function (\Illuminate\Http\Request $request) {
        return response()->json(['userId' => $request->user()->userId]);
    });

    // UserProfileController routes
    Route::get('/user/{userId?}', [UserProfileController::class, 'findByUserID']);
    Route::get('/users', [UserProfileController::class, 'findAllUsers']);
    Route::post('/befriend', [UserProfileController::class, 'befriend']);
    Route::post('/unfollow', [UserProfileController::class, 'unfollow']);

    Route::get('/test-token', [AuthController::class, 'testToken']);
});
