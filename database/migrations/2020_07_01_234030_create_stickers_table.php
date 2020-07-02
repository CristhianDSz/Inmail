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
            $table->enum('style',['square, dot, round']);
            $table->string('color');
            $table->enum('dateFormat',['dayMonthYear','monthYearDay','yearMonthDay']);
            $table->string('registrationTitle');
            $table->string('midTitle');
            $table->string('footerTitle');
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
