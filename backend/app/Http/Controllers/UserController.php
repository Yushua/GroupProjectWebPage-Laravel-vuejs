<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\ChangeUsernameRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function changeUsername(ChangeUsernameRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->username = $request->username;
                $user->save();
                return response()->json(['message' => 'Username updated successfully']);
            }
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating username: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getUsernameById($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                return response()->json(['username' => $user->username]);
            }
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching username by ID: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('Error fetching all users: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function createAccount(CreateAccountRequest $request)
    {
        try {
            // Create a new user without email
            $user = new User();
            $user->username = $request->username; // Save username
            $user->password = Hash::make($request->password); // Hash the password
            $user->save();

            // Create the token after saving the user
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Account created successfully',
                'token' => $token,
                'user_id' => $user->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating account: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during account creation'], 500);
        }
    }


    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json(['message' => 'Login successful', 'token' => $token, 'user_id' => $user->id]);
            }

            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            Log::error('Error during login: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during login'], 500);
        }
    }

    public function getUser(Request $request)
    {
        try {
            return response()->json($request->user());
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
}
