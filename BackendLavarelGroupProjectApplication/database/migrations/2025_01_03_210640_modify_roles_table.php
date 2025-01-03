<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Make the project_id nullable, so it can accept null values
            $table->string('ProjectID')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Revert the changes made
            $table->string('ProjectID')->nullable(false)->change();
        });
    }
};
