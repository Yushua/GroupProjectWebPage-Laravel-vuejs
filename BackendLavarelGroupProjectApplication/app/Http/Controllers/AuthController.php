<?php

namespace App\Http\Controllers;

use App\Models\JWTUserProfile;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register a new user
    public function register(RegisterUserRequest $request)
    {
        // Access validated data
        $validated = $request->validated();

        // Create the JWTUserProfile
        $user = JWTUserProfile::create([
            'username' => $validated['username'], // Use validated data
            'userId' => (string) \Illuminate\Support\Str::uuid(),
            'password' => Hash::make($validated['password']), // Hash the password
            'LoginCode' => '',
            'user_list' => [], // Initialize as empty array
        ]);

        // Create the associated DescriptionProfile
        \App\Models\DescriptionProfile::create([
            'userId' => $user->id,
            'description' => null,
            'roled' => null,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }


    // Login with JWT Token
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) { // Attempt login using JWTAuth
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create token', 'details' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Login successful', 'token' => $token]);
    }

    public function checkToken()
    {
        
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
