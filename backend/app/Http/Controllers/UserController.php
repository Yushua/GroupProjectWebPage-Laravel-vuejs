<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeUsernameRequest;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changeUsername(ChangeUsernameRequest $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->username = $request->username;
            $user->save();
            return response()->json(['message' => 'Username updated successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function getUsernameById($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['username' => $user->username]);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function getAllUsernames()
    {
        $users = User::select('id', 'username')->get();
        return response()->json($users);
    }

    public function createAccount(CreateAccountRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Account created successfully', 'token' => $token]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['message' => 'Login successful', 'token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }
}
