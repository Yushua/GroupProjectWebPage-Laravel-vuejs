<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthControllerUnsecure extends Controller
{
    // Register new user
    public function registerUnsecure(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|max:255|unique:user_profiles,username', // Ensure the username is unique
            'password' => 'required|string|min:8', // Password validation
        ]);

        // Create a new user profile
        $userProfile = UserProfile::create([
            'username' => $request->username,                    // Username
            'userId' => Str::uuid()->toString(),                  // Generate a unique userId
            'password' => Hash::make($request->password),         // Hash the password
            'LoginCode' => '',                                    // Initially no login code
            'user_list' => [],                                    // Empty user list
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Login with username and password
    public function loginUnsecure(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Find the user by username
        $userProfile = UserProfile::where('username', $request->username)->first();

        // Check if the user exists and if the password is correct
        if (!$userProfile || !Hash::check($request->password, $userProfile->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate a new login code
        $loginCode = Str::random(32);

        // Store the login code in the user's profile
        $userProfile->LoginCode = $loginCode;
        $userProfile->save();

        return response()->json(['message' => 'Login successful', 'LoginCode' => $loginCode]);
    }

    // Check if the connection is alive
    public function checkUnsecure()
    {
        return response()->json(['message' => 'yup, connection is there']);
    }

    // Return all users in the database
    public function allUsersUnsecure()
    {
        $users = UserProfile::all();
        return response()->json($users);
    }
}
