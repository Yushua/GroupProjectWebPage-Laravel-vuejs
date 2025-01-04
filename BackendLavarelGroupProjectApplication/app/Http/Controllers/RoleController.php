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
        // Validate input fields
        $request->validate([
            'project_id' => 'required|string',
            'roleName' => 'required',
            'description' => 'required',
        ]);
        $role = new Role();
        $role->RoleName = $request->roleName; // Use RoleName as column in DB
        $role->project_id = $request->project_id; // Use project_id as column in DB
        $role->description = $request->description; // Use description as column in DB
        $role->UserID = null; // Set UserID as null initially or modify as required
        $role->save();

        // Return success response
        return response()->json(['message' => 'Role created successfully'], 201);
    }

    public function getRolesByProject(Request $request, $projectId)
    {
        \Log::info('Project ID from token:', ['$projectId' => $projectId]);
        $project = Project::where('projectId', $projectId)->first();
        $userId = JWTAuth::parseToken()->getClaim('userId');
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        $users = $project->users;
        if (is_string($users)) {
            $users = json_decode($users, true);
        }
        $isUserPartOfProject = in_array($userId, $users);
        if (!$isUserPartOfProject) {
            return response()->json(['error' => 'User is not part of the project'], 403);
        }
        \Log::info('i am here');
        $roles = Role::where('project_id', $projectId)->get();
        return response()->json($roles);
    }
}
