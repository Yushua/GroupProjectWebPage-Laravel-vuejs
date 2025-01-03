<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('RoleName');  // Add the RoleName column
            $table->string('ProjectID');
            $table->text('Description');
            $table->unsignedBigInteger('UserID')->nullable();  // If UserID is nullable
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn(['RoleName', 'ProjectID', 'Description', 'UserID']);
        });
    }
};
