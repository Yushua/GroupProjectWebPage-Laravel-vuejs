<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

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

        // Create new role and assign values
        $role = new Role();
        $role->RoleName = $request->roleName; // Use RoleName as column in DB
        $role->project_id = $request->project_id; // Use project_id as column in DB
        $role->description = $request->description; // Use description as column in DB
        $role->UserID = null; // Set UserID as null initially or modify as required
        $role->save();

        // Return success response
        return response()->json(['message' => 'Role created successfully'], 201);
    }

    public function getRolesByProject(Request $request, $projectID)
    {
        $roles = Role::where('ProjectID', $projectID)->get();
        return response()->json($roles);
    }
}
