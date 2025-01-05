<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('taskId')->unique();
            $table->string('projectId');
            $table->string('roleId');
            $table->string('userId')->nullable(); // Allow NULL values
            $table->string('TaskName');
            $table->text('TaskDescription');
            $table->date('TaskDate');
            $table->timestamps();

            // Foreign keys
            $table->foreign('projectId')->references('projectId')->on('projects')->onDelete('cascade');
            $table->foreign('roleId')->references('roleId')->on('roles')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('user_profiles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
