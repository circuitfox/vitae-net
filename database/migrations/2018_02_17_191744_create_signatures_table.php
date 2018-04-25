<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            // attributes
            $table->bigIncrements('id');
            $table->bigInteger('medication_id')->unsigned();
            $table->integer('medical_record_number');
            $table->string('time');
            $table->string('student_name');
            $table->string('comments')->nullable();
            //keys
            $table->foreign('medical_record_number')
                ->references('medical_record_number')
                ->on('patients')
                ->onDelete('cascade');
            $table->foreign('medication_id')
                ->references('medication_id')
                ->on('medications')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatures');
    }
}
