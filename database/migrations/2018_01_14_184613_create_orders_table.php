<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //attributes
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('file_path');
            $table->integer('patient_id')->nullable();
            $table->boolean('completed')->default(0);
            $table->timestamps();
            //keys
            $table->foreign('patient_id')->references('medical_record_number')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
