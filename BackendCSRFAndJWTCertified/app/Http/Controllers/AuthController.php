<?php

namespace App\Http\Controllers;

use App\Models\JWTUserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user_profiles,username',
            'password' => 'required|string|min:8',
        ]);

        $user = JWTUserProfile::create([
            'username' => $request->username,
            'userId' => (string) \Illuminate\Support\Str::uuid(),
            'password' => Hash::make($request->password),
            'LoginCode' => '',
            'user_list' => [],
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Login with JWT Token
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {  // Use JWTAuth to attempt login
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create token', 'details' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Login successful', 'token' => $token]);
    }

    // Get authenticated user
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Return all users
    public function allUsers()
    {
        return response()->json(JWTUserProfile::all());
    }
}
