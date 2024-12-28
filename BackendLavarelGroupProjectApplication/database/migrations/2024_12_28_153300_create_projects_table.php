<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('projectId')->unique(); // Unique Project ID
        $table->string('name');
        $table->string('status')->default('closed'); // closed, public, private, abandoned
        $table->string('invite_code')->unique();
        $table->json('users')->nullable(); // JSON of user IDs attached to the project
        $table->timestamps();
    });
} /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
