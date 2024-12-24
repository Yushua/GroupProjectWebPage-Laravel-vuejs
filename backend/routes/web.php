<?php

use App\Http\Controllers\UserController;

Route::post('change-username/{id}', [UserController::class, 'changeUsername']);
Route::get('get-username/{id}', [UserController::class, 'getUsernameById']);
Route::get('get-all-usernames', [UserController::class, 'getAllUsernames']);
Route::post('create-account', [UserController::class, 'createAccount']);
Route::post('login', [UserController::class, 'login']);
