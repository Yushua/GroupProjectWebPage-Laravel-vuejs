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
        $users = is_string($project->users) ? json_decode($project->users, true) : $project->users;

        if (!is_array($users)) {
            return response()->json(['error' => 'Invalid users data in project'], 500);
        }
        $isUserInProject = in_array($userId, $users, true) || $project->roles()->where('roleId', $validated['roleId'])->where('userId', $userId)->exists();

        if (!$isUserInProject) {
            return response()->json(['error' => 'User is not part of the project'], 403);
        }
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

    public function getUserProjects(Request $request)
    {
        $userId = JWTAuth::parseToken()->getClaim('userId');
        \Log::info('User ID from token:', ['userId' => $userId]);

        $projects = Project::all();
        \Log::info('projects:', ['projects' => $projects]);

        $userProjects = $projects->filter(function ($project) use ($userId) {
            // Check if $project->users is a JSON string or already an array
            $users = is_string($project->users) ? json_decode($project->users, true) : $project->users;

            // Ensure $users is an array
            return is_array($users) && in_array($userId, $users, true);
        });

        \Log::info('userProjects', ['userProjects' => $userProjects]);

        $result = $userProjects->map(function ($project) {
            return [
                'projectId' => $project->projectId,
                'name' => $project->name,
                'description' => $project->description,
                'status' => $project->status,
            ];
        });

        return response()->json($result);
    }

    public function getTasksByRole(Request $request)
    {
        $validated = $request->validate([
            'projectId' => 'required|string',
            'roleId' => 'required|string',
        ]);

        $project = Project::where('projectId', $validated['projectId'])->first();
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $userId = JWTAuth::parseToken()->getClaim('userId');

        $users = is_string($project->users) ? json_decode($project->users, true) : $project->users;

        if (!is_array($users)) {
            return response()->json(['error' => 'Invalid users data in project'], 500);
        }

        $isUserInProject = in_array($userId, $users, true) || $project->roles()->where('userId', $userId)->exists();

        if (!$isUserInProject) {
            return response()->json(['error' => 'User is not part of the project'], 403);
        }

        $role = $project->roles()->where('roleId', $validated['roleId'])->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found in the project'], 404);
        }

        $tasks = Task::where('projectId', $validated['projectId'])
            ->where('roleId', $validated['roleId'])
            ->get();

        return response()->json(['tasks' => $tasks], 200);
    }

}

