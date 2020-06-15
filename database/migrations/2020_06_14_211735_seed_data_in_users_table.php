<?php

use Illuminate\Database\Migrations\Migration;

class SeedDataInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $seed = new UserSeeder();
        $seed->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
