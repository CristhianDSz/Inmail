<?php

use Illuminate\Database\Migrations\Migration;

class SeedDataInRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $seeder = new RoleSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
