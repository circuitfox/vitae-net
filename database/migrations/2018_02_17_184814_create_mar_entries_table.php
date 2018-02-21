<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mar_entries', function (Blueprint $table) {
            // attributes
            $table->bigInteger('medication_id')->unsigned();
            $table->integer('medical_record_number');
            $table->boolean('stat');
            $table->string('instructions');
            $table->integer('given_at');
            // keys
            $table->primary(['medical_record_number','medication_id']);
            $table->foreign('medical_record_number')->references('medical_record_number')->on('patients');
            $table->foreign('medication_id')->references('medication_id')->on('medications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mar_entries');
    }
}
