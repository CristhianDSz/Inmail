<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('qr_style', ['square', 'dot', 'round']);
            $table->string('qr_color');
            $table->enum('date_format', ['day_month_year', 'month_year_day', 'year_month_day']);
            $table->string('registration_title');
            $table->string('mid_title');
            $table->string('footer_title');
            $table->boolean('is_default')->default(false)->nullable();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stickers');
    }
}
