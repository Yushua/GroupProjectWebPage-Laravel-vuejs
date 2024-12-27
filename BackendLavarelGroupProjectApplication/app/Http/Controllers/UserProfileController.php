<?php

namespace App\Http\Controllers;

use App\Models\JWTUserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Find a user by userID. If no userID is provided, use the userID from the JWT token.
     *
     * @param  Request  $request
     * @param  string|null  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function findByUserID(Request $request, $userId = null)
    {
        if ($userId === null) {
            $userId = Auth::user()->userId;//if user ID not given. use bearer token ID
        }

        $user = JWTUserProfile::where('userId', $userId)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'username' => $user->username,
            'friendlist' => $user->user_list,
        ]);
    }

    /**
     * Find all users except the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAllUsers()
    {
        $currentUserId = Auth::user()->userId;

        $users = JWTUserProfile::where('userId', '!=', $currentUserId)
            ->get(['username', 'userId']);

        return response()->json($users);
    }

    /**
     * Add a userID to the friendlist of the authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function befriend(Request $request)
    {
        $request->validate([
            'userId' => 'required|string|exists:user_profiles,userId',
        ]);

        $currentUser = Auth::user();
        $friendId = $request->userId;

        if (!in_array($friendId, $currentUser->user_list)) {
            $currentUser->user_list[] = $friendId;
            $currentUser->save();
        }

        return response()->json(['message' => 'User befriended successfully']);
    }

    /**
     * Remove a userID from the friendlist of the authenticated user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollow(Request $request)
    {
        $request->validate([
            'userId' => 'required|string|exists:user_profiles,userId',
        ]);

        $currentUser = Auth::user();
        $friendId = $request->userId;

        $currentUser->user_list = array_filter($currentUser->user_list, function ($id) use ($friendId) {
            return $id !== $friendId;
        });

        $currentUser->save();

        return response()->json(['message' => 'User unfollowed successfully']);
    }
}
