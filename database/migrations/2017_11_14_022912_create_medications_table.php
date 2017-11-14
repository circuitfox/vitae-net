<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            //attributes
            $table->integer('medication_id');
            $table->string('name');
            $table->integer('dosage_amount');
            $table->string('dosage_type');
            $table->string('instructions');
            $table->string('comments')->nullable();
            $table->boolean('stat');
            $table->timestamps();
            //indexes
            $table->primary('medication_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
}
