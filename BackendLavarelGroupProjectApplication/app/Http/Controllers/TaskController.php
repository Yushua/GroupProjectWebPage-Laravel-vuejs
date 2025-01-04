<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use JWTAuth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'projectId' => 'required|string',
            'roleId' => 'required|string',
            'userId' => 'required|string',
            'taskName' => 'required|string',
            'taskDescription' => 'required|string',
            'taskDate' => 'required|date',
        ]);

        $project = Project::where('projectId', $validated['projectId'])->first();
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $userId = JWTAuth::parseToken()->getClaim('userId');
        $users = $project->users;
        if (is_string($users)) {
            $users = json_decode($users, true);
        }

        if (!in_array($validated['userId'], $users)) {
            return response()->json(['error' => 'User not found in this project'], 404);
        }
        $role = $project->roles()->where('roleId', $validated['roleId'])->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found in the project'], 404);
        }

        $task = Task::create([
            'TaskID' => uniqid(),
            'ProjectID' => $validated['projectId'],
            'RoleID' => $validated['roleId'],
            'UserID' => $validated['userId'],
            'TaskName' => $validated['taskName'],
            'TaskDescription' => $validated['taskDescription'],
            'TaskDate' => $validated['taskDate'],
        ]);

        return response()->json(['task' => $task], 201);
    }
}

