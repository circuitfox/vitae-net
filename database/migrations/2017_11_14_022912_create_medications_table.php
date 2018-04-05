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
            $table->bigIncrements('medication_id');
            $table->string('name');
            $table->decimal('dosage_amount', 5, 2)->nullable();
            $table->string('dosage_unit')->nullable();
            $table->decimal('second_amount', 5, 2)->nullable();
            $table->string('second_unit')->nullable();
            $table->string('second_type')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('medications');
    }
}
