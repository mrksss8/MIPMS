<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('age');
            $table->integer('weight');
            $table->integer('height');
            $table->string('BP');
            $table->string('PR');
            $table->string('RR');
            $table->string('CC');
            $table->string('other_info')->nullable();
            $table->integer('patient_id');
            $table->integer('treatment_id')->nullable();
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
        Schema::dropIfExists('consultations');
    }
};
