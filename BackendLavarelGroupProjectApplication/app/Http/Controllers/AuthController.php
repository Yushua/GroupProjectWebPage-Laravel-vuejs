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
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create token', 'details' => $e->getMessage()], 500);
        }

        // Generate a JWT token with userId and expiration
        $customToken = $this->generateJWTToken(auth()->user()->userId);

        return response()->json([
            'message' => 'Login successful',
            'token' => $customToken
        ]);
    }

    /**
     * Generate a custom JWT token with userId and expiration.
     */
    private function generateJWTToken($userId)
    {
        $payload = [
            'sub' => $userId, // Subject: userId
            'exp' => now()->addHours(2)->timestamp, // Token expiration: 2 hours
        ];

        return \Firebase\JWT\JWT::encode($payload, env('JWT_SECRET'), 'HS256');
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
