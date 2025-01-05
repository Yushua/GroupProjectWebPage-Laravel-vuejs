<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Project;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleController extends Controller
{
    public function getAllRoles()
    {
        $roles = [
            'Backend',
            'Frontend',
            'Fullstack',
            'Designer',
            'Software Engineer',
            'Software Developer',
            'React',
            'UX Design',
        ];
        return response()->json($roles);
    }

    public function createRole(Request $request)
    {
        // Validate input fields with correct names
        $request->validate([
            'projectId' => 'required|string', // Ensure projectId is used in the request
            'roleName' => 'required|string', // Ensure roleName is used in the request
            'description' => 'required|string', // Ensure description is used in the request
        ]);

        // Create a new role with the provided input values
        $role = new Role();
        $role->RoleName = $request->roleName; // Map to RoleName in DB
        $role->roleId = uniqid();
        $role->projectId = $request->projectId; // Map to projectId in DB
        $role->description = $request->description; // Map to description in DB
        $role->UserId = null; // Set UserId as null initially or modify as required
        $role->save();

        // Return success response
        return response()->json(['message' => 'Role created successfully'], 201);
    }

    public function getRolesByProject(Request $request, $projectId)
    {
        \Log::info('Project ID from token:', ['$projectId' => $projectId]);
        $project = Project::where('projectId', $projectId)->first();
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $userId = JWTAuth::parseToken()->getClaim('userId');
        $users = $project->users; // Corrected to match your relationships

        if (is_string($users)) {
            $users = json_decode($users, true);
        }

        $isUserPartOfProject = in_array($userId, $users);
        if (!$isUserPartOfProject) {
            return response()->json(['error' => 'User is not part of the project'], 403);
        }

        \Log::info('i am here in get roles by project');
        $roles = Role::where('projectId', $projectId)->get();
        return response()->json($roles);
    }
}
