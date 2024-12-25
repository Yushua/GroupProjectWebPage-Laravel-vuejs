<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Login method that returns JWT token
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Get user instance
            $user = Auth::user();
            // Generate JWT token
            $token = JWTAuth::fromUser($user);
            // Return response with token
            return response()->json([
                'token' => $token,
            ]);
        }

        // If authentication fails
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Method to get authenticated user details
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}

