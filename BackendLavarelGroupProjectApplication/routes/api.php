<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DescriptionProfileController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes (JWT authentication required)
Route::middleware('jwt.auth')->group(function () {
    Route::get('/all-users', [AuthController::class, 'allUsers']);
    Route::get('/profile', function (Request $request) {
        return response()->json(['userId' => $request->user()->userId]);
    });

    // UserProfileController routes
    Route::get('/user/{userId?}', [UserProfileController::class, 'findByUserID']);
    Route::get('/users', [UserProfileController::class, 'findAllUsers']);
    Route::post('/befriend', [UserProfileController::class, 'befriend']);
    Route::post('/unfollow', [UserProfileController::class, 'unfollow']);

    // DescriptionProfileController routes
    Route::put('/updatedescription-profile', [DescriptionProfileController::class, 'updateDescription']);
    Route::get('/user-descriptionYWT', [DescriptionProfileController::class, 'getUserDescriptionJWT']);
    Route::get('/user-description/{userId?}', [DescriptionProfileController::class, 'getUserDescription']);
});
