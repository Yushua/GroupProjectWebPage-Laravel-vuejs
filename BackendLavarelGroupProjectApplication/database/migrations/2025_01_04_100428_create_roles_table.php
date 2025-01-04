<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // auto-incrementing id
            $table->string('RoleId'); // Added RoleId column
            $table->string('RoleName');
            $table->string('projectId'); // Corrected column name
            $table->text('Description');
            $table->string('userId')->nullable(); // Ensure userId exists and is nullable
            $table->timestamps();

            // Foreign Key constraints
            $table->foreign('projectId')->references('projectId')->on('projects')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('user_profiles')->onDelete('set null');  // Reference to user_profiles table
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
