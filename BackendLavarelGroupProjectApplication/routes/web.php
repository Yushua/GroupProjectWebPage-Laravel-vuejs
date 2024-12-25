<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthControllerUnsecure;

Route::post('/register-unsecure', [AuthControllerUnsecure::class, 'registerUnsecure']);
Route::post('/login-unsecure', [AuthControllerUnsecure::class, 'loginUnsecure']);
Route::get('/check-unsecure', [AuthControllerUnsecure::class, 'checkUnsecure']);
Route::get('/all-users-unsecure', [AuthControllerUnsecure::class, 'allUsersUnsecure']);
