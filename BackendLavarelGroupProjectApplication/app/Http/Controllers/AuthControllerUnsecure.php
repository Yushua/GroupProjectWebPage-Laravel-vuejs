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
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user profile
        $userProfile = UserProfile::create([
            'name' => $request->name,
            'password' => Hash::make($request->password), // Hash the password
            'LoginCode' => '', // Initially no login code
            'user_list' => [], // Empty list
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Login with username and password
    public function loginUnsecure(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Find the user by name
        $userProfile = UserProfile::where('name', $request->name)->first();

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
