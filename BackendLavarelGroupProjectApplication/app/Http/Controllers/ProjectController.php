<?php

// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Create a new project
    public function createProject(Request $request)
    {
        $project = Project::create([
            'projectId' => uniqid(),  // Generate a unique Project ID
            'name' => $request->name,
            'invite_code' => uniqid(), // Generate a random invite code
            'status' => 'closed',
            'users' => json_encode([$request->user()->id]), // Add creator user initially
        ]);

        return response()->json($project);
    }

    // Add a role to a project
    public function addRole(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $role = new Role([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
        ]);

        $project->roles()->save($role);

        return response()->json($role);
    }

    // Add a task to a project
    public function addTask(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $role = Role::find($request->role_id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $task = new Task([
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);

        $project->tasks()->save($task);

        return response()->json($task);
    }

    // Get project users
    public function getProjectUsers($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json(json_decode($project->users));
    }

    // Add user to project via Invite Code
    public function addUserToProject(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        if ($request->invite_code === $project->invite_code) {
            $users = json_decode($project->users);
            $users[] = Auth::user()->id;
            $project->users = json_encode($users);
            $project->save();
            return response()->json(['success' => 'User added to the project']);
        } else {
            return response()->json(['error' => 'Invalid invite code'], 400);
        }
    }

    // Get Invite code
    public function getInviteCode($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json(['invite_code' => $project->invite_code]);
    }
}

