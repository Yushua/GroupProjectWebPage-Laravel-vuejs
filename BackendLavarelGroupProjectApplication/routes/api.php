<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DescriptionProfileController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;

Route::options('/{any}', function (Request $request) {
    return response()->json([], 200);
})->where('any', '.*');

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

    Route::post('/CreateProject', [ProjectController::class, 'createProject']);
    Route::get('/project-statuses', [ProjectController::class, 'getProjectStatuses']);
    Route::middleware('auth:api')->get('/projects', [ProjectController::class, 'getUserProjects']);

    Route::post('/project/{projectId}/role', [ProjectController::class, 'addRole']); // Add role to project
    Route::post('/project/{projectId}/task', [ProjectController::class, 'addTask']); // Add task to project
    Route::get('/project/{projectId}/users', [ProjectController::class, 'getProjectUsers']); // Get project users
    Route::post('/project/{projectId}/invite', [ProjectController::class, 'addUserToProject']); // Add user to project using invite
    Route::get('/project/{projectId}/invite-code', [ProjectController::class, 'getInviteCode']); // Get project invite code

});
