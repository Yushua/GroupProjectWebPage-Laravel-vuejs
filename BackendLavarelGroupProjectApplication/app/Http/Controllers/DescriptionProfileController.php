<?php

namespace App\Http\Controllers;

use App\Models\DescriptionProfile;
use App\Models\JWTUserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DescriptionProfileController extends Controller
{
    /**
     * Create a description profile for a user.
     *
     * @param JWTUserProfile $userProfile
     * @return void
     */
    public static function createDescriptionProfile(JWTUserProfile $userProfile)
    {
        DescriptionProfile::create([
            'userId' => $userProfile->id,
            'description' => null,
            'roled' => null,
        ]);
    }

    /**
     * Update the description and role.
     *
     * @param Request $request
     * @param int $descriptionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDescription(Request $request)
    {
        // Validate the input
        $request->validate([
            'description' => 'nullable|string|max:255',
            'roled' => 'nullable|in:Leader,Trainer,Writer',
        ]);

        // Get the authenticated user's userId
        $userId = Auth::user()->userId;

        // Find the description profile linked to this userId
        $descriptionProfile = DescriptionProfile::where('userId', $userId)->first();

        if (!$descriptionProfile) {
            return response()->json(['error' => 'Description profile not found'], 404);
        }

        // Update the description profile with the provided data
        $descriptionProfile->update($request->only(['description', 'roled']));

        return response()->json(['message' => 'Description profile updated successfully']);
    }

    public function getUserDescriptionJWT(Request $request)
    {
        $userId = Auth::user()->userId; // Extract the authenticated user's ID

        // Find the user by userId
        $user = JWTUserProfile::where('userId', $userId)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Find the user's description profile
        $description = DescriptionProfile::where('userId', $user->id)->first();
        if (!$description) {
            return response()->json(['error' => 'Description profile not found'], 404);
        }

        // Return the full user description
        return response()->json([
            'username' => $user->username,
            'userId' => $user->userId,
            'description' => $description->description,
            'roled' => $description->roled,
        ]);
    }

    public function getUserDescription(Request $request, $userId = null)
    {

        // Find the user by userId
        $user = JWTUserProfile::where('userId', $userId)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Find the user's description profile
        $description = DescriptionProfile::where('userId', $user->id)->first();
        if (!$description) {
            return response()->json(['error' => 'Description profile not found'], 404);
        }

        // Return the full user description
        return response()->json([
            'username' => $user->username,
            'userId' => $user->userId,
            'description' => $description->description,
            'roled' => $description->roled,
        ]);
    }

}

