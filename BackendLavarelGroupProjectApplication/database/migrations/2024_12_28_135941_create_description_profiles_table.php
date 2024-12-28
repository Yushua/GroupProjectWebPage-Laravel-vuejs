<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('description_profiles', function (Blueprint $table) {
            $table->id('descriptionId'); // Auto-increment ID
            $table->unsignedBigInteger('userId'); // Foreign key to UserProfile
            $table->string('description')->nullable(); // Description can be empty
            $table->enum('roled', ['Leader', 'Trainer', 'Writer'])->nullable(); // Restricted roles
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('user_profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('description_profiles');
    }
}

