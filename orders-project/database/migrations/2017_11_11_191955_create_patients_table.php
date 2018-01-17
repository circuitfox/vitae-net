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
            $table->increments('id');
            $table->string('MRN');
            $table->string('fname');
            $table->string('lname');
            $table->date('DOB');
            $table->string('sex');
            $table->string('height');
            $table->string('weight');
            $table->string('diagnosis');
            $table->string('allergies');
            $table->string('physician');
            $table->string('code_status');

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
