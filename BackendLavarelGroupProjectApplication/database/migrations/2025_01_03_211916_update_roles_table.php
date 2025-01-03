<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolesTable extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Check if the 'RoleName' column exists, and if it does, don't try to add it again
            if (!Schema::hasColumn('roles', 'RoleName')) {
                $table->string('RoleName')->after('project_id');
            }

            // Check if the 'Description' column exists, and if it does, don't try to add it again
            if (!Schema::hasColumn('roles', 'Description')) {
                $table->text('Description')->after('role_description');
            }

            // Check and change the 'project_id' column type if necessary
            if (Schema::hasColumn('roles', 'project_id') && \DB::getSchemaBuilder()->getColumnType('roles', 'project_id') !== 'bigint') {
                $table->bigInteger('project_id')->unsigned()->change();
            }

            // Add the foreign key constraint if not already present (you need to ensure the foreign key manually)
            // If you are sure the foreign key exists, you can skip this check.
            // No `hasForeignKey` method, so just ensure the foreign key is properly added:
            try {
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            } catch (\Exception $e) {
                // Ignore any errors related to the foreign key already existing
            }
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['project_id']);

            // Drop columns if necessary
            $table->dropColumn(['RoleName', 'Description']);
        });
    }
}


