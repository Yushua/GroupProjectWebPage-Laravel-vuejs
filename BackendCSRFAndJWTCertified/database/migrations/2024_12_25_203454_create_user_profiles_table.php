<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();                          // id column
            $table->string('username')->unique();   // username column
            $table->string('userId')->unique();     // userId column
            $table->string('password');             // password column
            $table->string('LoginCode')->nullable(); // login code column
            $table->json('user_list')->nullable();  // user_list column
            $table->timestamps();                  // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
