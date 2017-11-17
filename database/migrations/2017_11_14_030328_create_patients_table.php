<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            //attributes
            $table->integer('medical_record_number');
            $table->string('last_name');
            $table->string('first_name');
            $table->date('date_of_birth');
            $table->boolean('sex');
            $table->string('physician');
            $table->string('room');
            $table->timestamps();
            //indexes
            $table->primary('medical_record_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
