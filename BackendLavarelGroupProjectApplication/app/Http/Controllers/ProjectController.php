<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\Message;
use Illuminate\Http\Request;
use App\DTOs\CreateProjectDTO;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Create a new project
    public function createProject(Request $request)
    {
        $validated = $request->validate([
            'ProjectName' => 'required|string|max:255',
            'ProjectDescription' => 'required|string|max:1000',
        ]);

        $projectDTO = CreateProjectDTO::fromRequest($request);

        // Create the project with an owner (current authenticated user)
        $project = Project::create([
            'projectId' => uniqid(),
            'name' => $projectDTO->ProjectName,
            'invite_code' => uniqid(),
            'status' => 'created',
            'users' => json_encode([$request->user()->id]),
            'description' => $projectDTO->ProjectDescription,
            'owner_id' => $request->user()->id, // Store the owner
        ]);

        return response()->json($project, 201);
    }

    // Change the status of the project (only for owner)
    public function changeProjectStatus(Request $request, $projectId)
    {
        $validated = $request->validate([
            'status' => 'required|in:created,InProgressPublic,InProgressPrivate,Public,Private',
        ]);

        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        // Check if the user is the owner
        if ($project->owner_id !== $request->user()->id) {
            return response()->json(['error' => 'You are not authorized to change the status of this project'], 403);
        }

        // Update the status
        $project->status = $validated['status'];
        $project->save();

        return response()->json($project);
    }

    // Add a role to a project
    public function addRole(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        // Check if the user is the owner
        if ($project->owner_id !== $request->user()->id) {
            return response()->json(['error' => 'You are not authorized to add roles to this project'], 403);
        }

        $role = new Role([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
        ]);

        $project->roles()->save($role);

        return response()->json($role);
    }

    // Add a task to a project (any authenticated user)
    public function addTask(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        // Create the task
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
