<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Change username
    public function changeUsername(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->username = $request->username;
            $user->save();
            return response()->json(['message' => 'Username updated successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    // Get username by ID
    public function getUsernameById($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['username' => $user->username]);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    // Get all usernames and IDs
    public function getAllUsernames()
    {
        $users = User::select('id', 'username')->get();
        return response()->json($users);
    }

    // Create account
    public function createAccount(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Account created successfully']);
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login successful']);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
