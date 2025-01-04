<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use JWTAuth;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        $validated = $request->validate([
            'projectId' => 'required|string',
            'roleId' => 'required|string',
            'taskName' => 'required|string',
            'taskDescription' => 'required|string',
            'taskDate' => 'required|date',
        ]);

        $project = Project::where('projectId', $validated['projectId'])->first();
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $userId = JWTAuth::parseToken()->getClaim('userId');

        // Debugging output
        // dd($project->users); // Uncomment this line to debug

        // Decode users array if it's stored as a JSON string
        $users = is_string($project->users) ? json_decode($project->users, true) : $project->users;

        // Check if users is actually an array after decoding
        if (!is_array($users)) {
            return response()->json(['error' => 'Invalid users data in project'], 500);
        }

        // Check if the user is part of the project
        $isUserInProject = in_array($userId, $users, true) || $project->roles()->where('roleId', $validated['roleId'])->where('userId', $userId)->exists();

        if (!$isUserInProject) {
            return response()->json(['error' => 'User is not part of the project'], 403);
        }

        // Check if the role exists in the project
        $role = $project->roles()->where('roleId', $validated['roleId'])->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found in the project'], 404);
        }

        // Create the task
        $task = Task::create([
            'taskId' => uniqid(),
            'projectId' => $validated['projectId'],
            'roleId' => $validated['roleId'],
            'userId' => $userId,
            'TaskName' => $validated['taskName'],
            'TaskDescription' => $validated['taskDescription'],
            'TaskDate' => $validated['taskDate'],
        ]);

        return response()->json(['task' => $task], 201);
    }

}

