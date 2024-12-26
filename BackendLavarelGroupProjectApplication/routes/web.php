<?php

// routes/web.php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

// Your other routes
use App\Http\Controllers\AuthControllerUnsecure;
use App\Http\Controllers\AuthController;

Route::post('/register-unsecure', [AuthControllerUnsecure::class, 'registerUnsecure']);
Route::post('/login-unsecure', [AuthControllerUnsecure::class, 'loginUnsecure']);
Route::get('/check-unsecure', [AuthControllerUnsecure::class, 'checkUnsecure']);
Route::get('/all-users-unsecure', [AuthControllerUnsecure::class, 'allUsersUnsecure']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

