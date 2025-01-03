<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Update the owner_id column to store UUID as string
            $table->string('owner_id', 36)->change(); // 36 characters for UUID
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Rollback to integer type if needed (assuming your DB was originally integer type)
            $table->integer('owner_id')->change();
        });
    }
};
