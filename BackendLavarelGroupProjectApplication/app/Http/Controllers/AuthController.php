<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\JWTUserProfile;
use App\Models\DescriptionProfile;
use Hash;
use JWTAuth;

class AuthController extends Controller
{
    // Register method
    public function register(RegisterUserRequest $request)
    {
        // The request is already validated by RegisterUserRequest

        // Create the JWTUserProfile
        $user = JWTUserProfile::create([
            'username' => $request->username, // Use validated request data
            'userId' => (string) \Illuminate\Support\Str::uuid(),
            'password' => Hash::make($request->password), // Hash the password
            'LoginCode' => '',
            'user_list' => [], // Initialize as empty array
        ]);

        // Create the associated DescriptionProfile
        DescriptionProfile::create([
            'userId' => $user->id,
            'description' => null,
            'roled' => null,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (!$user = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $userProfile = JWTUserProfile::where('username', $request->username)->first();
            if (!$userProfile) {
                return response()->json(['error' => 'User profile not found'], 400);
            }
            \Log::info('User ID being assigned to token:', ['userId' => $userProfile->userId]);
            $token = JWTAuth::fromUser($userProfile, ['userId' => $userProfile->userId]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not create token', 'details' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Login successful', 'token' => $token]);
    }
}

