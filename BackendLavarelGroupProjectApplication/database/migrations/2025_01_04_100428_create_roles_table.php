<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('roleId')->unique(); // Adding a unique index
            $table->string('RoleName');
            $table->string('projectId');
            $table->text('Description');
            $table->string('userId')->nullable();
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
