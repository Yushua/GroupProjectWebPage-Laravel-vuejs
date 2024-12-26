<?php

use Illuminate\Support\Facades\Route;

// Public routes for the web interface
Route::get('/', function () {
    return view('welcome');
});

// CSRF token endpoint (this can stay here since it's commonly web-related)
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
