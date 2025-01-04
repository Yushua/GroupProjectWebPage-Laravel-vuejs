<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;

class FixUsersFieldInProjectsTable extends Migration
{
    public function up()
    {
        // Update existing projects to convert the 'users' field to an array
        $projects = Project::all();

        foreach ($projects as $project) {
            if (is_string($project->users)) {
                // Decode the string into an array and save back
                $project->users = json_decode($project->users, true);
                $project->save();
            }
        }
    }

    public function down()
    {
        // If needed, you could re-encode the array to a string here
        $projects = Project::all();

        foreach ($projects as $project) {
            if (is_array($project->users)) {
                // Convert array to JSON string and save it back
                $project->users = json_encode($project->users);
                $project->save();
            }
        }
    }
}
