<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('hour');
            $table->string('number');
            $table->enum('type', ['Entrada', 'Salida']);
            $table->enum('document_type', ['Correo', 'Facturas'])->default('Correo');
            $table->date('document_date');
            $table->string('invoice_number');
            $table->text('description');
            $table->string('attacheds');
            $table->enum('status', ['Creado', 'Registrado', 'Entregado', 'Visado Control Interno', 'Visado Contabilidad'])->default('Creado');
            $table->integer('copy')->default(2);
            $table->unsignedBigInteger('third_party_id')->nullable();
            $table->unsignedBigInteger('dependency_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('third_party_id')->references('id')->on('third_parties')->onDelete('set null');
            $table->foreign('dependency_id')->references('id')->on('dependencies')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
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
        Schema::dropIfExists('records');
    }
}
